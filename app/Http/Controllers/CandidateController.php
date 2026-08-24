<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'adminCanditate', 'edit', 'jobDetail', 'appliedJob', 'candidateResume']);
    }

    public function index()
    {
        $user = Auth::user();

        // Just create the candidate with user_id if it doesn't exist
        $candidate = Candidate::firstOrCreate(['user_id' => $user->id]);

        // Load relations after ensuring candidate exists
        $candidate->load(['user', 'skills', 'education', 'languages', 'category']);

        return view('candidate.profile_detail', compact('candidate'));
    }


    public function adminCandidate()
    {
        $mdata = Candidate::with('user')->whereHas('user', function ($q) {
            $q->where('role', 'candidate');
        })->get();

        return view('admin.candidate.index', compact('mdata'));
    }

    public function edit()
    {
        $user = Auth::user();

        $candidate = Candidate::firstOrCreate(['user_id' => $user->id]);
        $candidate->load(['user', 'skills', 'education', 'languages', 'category']);

        $categories = Category::all();
        return view('candidate.profile_edit', compact('candidate', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        // Validate request
        $request->validate([
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'job_title' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'min_salary' => 'nullable|numeric',
            'experience' => 'nullable|string',
            'mobile' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pin' => 'nullable|string',
        ]);

        // Image upload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/resource'), $filename);
            $candidate->image = $filename;
        }

        // Basic fields
        $candidate->job_title = $request->input('job_title');
        $candidate->description = $request->description;
        $candidate->min_salary = $request->input('min_salary');
        $candidate->experience = $request->input('experience');
        $candidate->address = $request->input('address');
        $candidate->city = $request->input('city');
        $candidate->state = $request->input('state');
        $candidate->country = $request->input('country');
        $candidate->pin = $request->input('pin');
        $candidate->updated_at = now();

        // Associate category (if present)
        if ($request->filled('category_id')) {
            $candidate->category()->associate($request->input('category_id'));
        } else {
            $candidate->category()->dissociate();
        }

        // Update related user's phone
        if ($candidate->user) {
            $candidate->user->phone = $request->input('phone');
            $candidate->user->save();
        }

        // Save candidate
        $candidate->save();

        // Update related models (skills, education, languages)
        // First delete old ones
        $candidate->skills()->delete();
        $candidate->languages()->delete();
        $candidate->education()->delete();

        // Then insert new ones
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'skill') && !empty($value)) {
                $candidate->skills()->create(['name' => $value]);
            }

            if (str_starts_with($key, 'language') && !empty($value)) {
                $index = str_replace('language', '', $key);
                $levelKey = 'level' . $index;
                $candidate->languages()->create([
                    'language' => $value,
                    'level' => $request->input($levelKey)
                ]);
            }

            if (str_starts_with($key, 'educationD') && !empty($value)) {
                $index = str_replace('educationD', '', $key);
                $candidate->education()->create([
                    'degree' => $value,
                    'institute' => $request->input('educationC' . $index),
                    'year' => $request->input('educationY' . $index),
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully.',
            'redirect_url' => route('candidate.detail'),
        ]);
    }

    public function jobapply($jobId)
    {
        $userId = Auth::id();

        // Get the candidate record for the logged-in user
        $candidate = Candidate::where('user_id', $userId)->first();

        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found.');
        }

        // Check if already applied
        $alreadyApplied = $candidate->appliedJobs()->where('job_id', $jobId)->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('warning', 'You have already applied to this job.');
        }

        // Apply to the job (store in pivot table)
        $candidate->appliedJobs()->attach($jobId);

        return redirect()->route('candidate.appliedJob')->with('success', 'Application submitted successfully.');
    }


    public function appliedJob()
    {
        $userId = Auth::id(); 
        $candidate = Candidate::where('user_id', $userId)->first();

        if ($candidate) {
            // Get the jobs the candidate has applied to
            $jobs = $candidate->appliedJobs()->with('company', 'category')->get();
        } else {
            $appliedJobs = collect(); // empty collection if candidate not found
        }

        return view('candidate.applied_jobs', compact('jobs'));
    }


    public function candidateResume()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        return view('candidate.resume', compact('documents'));
    }


    public function storeFiles(Request $request)
    {
        // Validate file type and size
        $request->validate([
            'fileId' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // 2MB
        ]);

        // Handle the file upload
        $file = $request->file('fileId');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . $originalName;

        // Get file size in KB (rounded to 2 decimal places)
        $fileSizeKB = round($file->getSize() / 1024, 2); // in KB

        // Store in 'public/storage/documents' folder
        $file->move(public_path('images/resource'), $filename);

        // Save record in the database
        Document::create([
            'user_id'       => Auth::id(),
            'filename'      => $filename,
            'original_name' => $originalName,
            'extension'     => $extension,
            'size_kb'       => $fileSizeKB, // assuming 'size_kb' column exists
            'uploaded_at'   => now()
        ]);

        // 6. Redirect with success message
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    public function destroy(Document $document)
    {
        $filePath = public_path('images/resource/' . $document->filename);

        if (file_exists($filePath)) {
            unlink($filePath); // delete from filesystem
        }

        $document->delete();

        return redirect()->back()->with('success', 'Document deleted.');
    }
}
