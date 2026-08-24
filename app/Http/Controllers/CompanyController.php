<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    public function __construct()
    {
        // Apply 'auth' middleware only to these methods
        $this->middleware('auth')->only(['index']);
    }

    public function index()
    {
        $user = Auth::user();
        // Just create the candidate with user_id if it doesn't exist
        $company = company::firstOrCreate(['user_id' => $user->id]);
        // Load relations after ensuring candidate exists
        $company->load(['user', 'jobs', 'categories', 'skills', 'socialLinks']);
        return view('company.profile_detail', compact('company'));
    }


    public function edit()
    {
        $user = Auth::user();
        $company = Company::firstOrCreate(['user_id' => $user->id]);
        $company->load(['user', 'jobs', 'categories', 'skills', 'socialLinks']);
        $categories101 = Category::all();
        return view('company.profile_edit', compact('company', 'categories101'));
    }



    public function update(Request $request, $id)
    {
        $user_id = $id;
        $company = Company::findOrFail($user_id);

        // Validate request
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'company_name' => 'required|string|max:255',
            'since' => 'nullable|string|max:100',
            'team_size' => 'nullable|numeric',
            'description' => 'nullable|string',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'hr_email' => 'nullable',
            'website' => 'nullable|url',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'pin' => 'nullable|string|max:20',
            'status' => 'nullable|boolean',
            'category_id' => 'nullable|array',
            'category_id.*' => 'exists:categories,id',
        ]);

        // Image upload
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/resource'), $filename);
            $company->company_image = $filename;
        }

        // Basic fields
        $company->company_name = $request->input('company_name');
        $company->since = $request->input('since');
        $company->team_size = $request->input('team_size');
        $company->description = $request->input('description');
        $company->website = $request->input('website');
        $company->address = $request->input('address');
        $company->city = $request->input('city');
        $company->state = $request->input('state');
        $company->hr_email = $request->input('hr_email');
        $company->country = $request->input('country');
        $company->pin = $request->input('pin');
        $company->status = $request->input('status', 1);
        $company->updated_at = now();


        // Save company
        $company->save();

        if ($company->user) {
            $company->user->phone = $request->input('phone'); 
            $company->user->save();
        }

        // Update related models

        $company->categories()->sync($request->input('category_id', []));

        // Skills (delete old and insert new)
        $company->skills()->delete();
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'skill') && !empty($value)) {
                $company->skills()->create(['skill' => $value]);
            }
        }

        // Social links (delete old and insert new)
        $company->socialLinks()->delete();
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'socialLinks') && !empty($value)) {
                $company->socialLinks()->create(['url' => $value]);
            }
        }

        // Return JSON response
        return response()->json([
            'status' => 'success',
            'message' => 'Company updated successfully.',
            'redirect_url' => route('company.detail')
        ]);
    }


    public function appliedCandidate()
    {
        $companyId = Auth::id();
        $candidates = Candidate::whereHas('appliedJobs', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->with('user')->get();
        return view('company.applied_candidate', compact('candidates'));
    }


    public function candidateDetail($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('candidate.profile_detail', compact('candidate'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'candidate_id' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'application_status' => 'required',
        ]);

        // Example: Send notification or save message
        $candidate = Candidate::find($validated['candidate_id']);

        $data = [
            'full_name' => $candidate->user->name,
            'job_title' => $candidate->job_title,
            'email' => $candidate->user->email,
            'subject' => $request->subject,
            'message'   => $request->message,
            'application_status' => $request->application_status,
        ];

        // Send confirmation to user
        Mail::to('surinder321992@gmail.com')->send(new ApplicationStatusMail($data));

        return response()->json([
            'message' => 'Message sent successfully.',
            'reload' => true
        ]);
    }

    public function changePassword()
    {
        return view('company.change_password');
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'company_name' => 'required|string|max:255',
            'since' => 'nullable|string|max:100',
            'team_size' => 'nullable|numeric',
            'description' => 'nullable|string',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'hr_email' => 'nullable|email',
            'website' => 'nullable|url',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'pin' => 'nullable|string|max:20',
            'status' => 'nullable|boolean',
            'job_category' => 'nullable',
        ]);

        // Handle image upload
        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/resource'), $filename);
        }

        // Create new company
        $company = Company::create([
            'company_name' => $validated['company_name'],
            'company_image' => $filename,
            'since' => $validated['since'] ?? null,
            'team_size' => $validated['team_size'] ?? null,
            'description' => $validated['description'] ?? null,
            'hr_email' => $validated['hr_email'] ?? null,
            'website' => $validated['website'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'country' => $validated['country'] ?? null,
            'pin' => $validated['pin'] ?? null,
            'status' => $validated['status'] ?? 1,
            'user_id' => Auth::id(),
        ]);

        // Update related user (e.g. phone/email if applicable)
        if ($company->user) {
            $company->user->phone = $validated['mobile'] ?? null;
            $company->user->save();
        }

        // Attach categories
        $company->categories()->sync($validated['job_category']);

        // Add skills
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'skill') && !empty($value)) {
                $company->skills()->create(['skill' => $value]);
            }
        }

        // Add social links
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'socialLinks') && !empty($value)) {
                $company->socialLinks()->create(['url' => $value]);
            }
        }

        // Return response
        return response()->json([
            'status' => 'success',
            'message' => 'Company created successfully.',
            'redirect_url' => route('admin.companies') // Change this as per your route names
        ]);
    }

    public function editCompany($id)
    {
        $company = Company::where('id', $id)->firstOrFail();
        $categories101 = Category::all();

        return view('admin.company.edit', compact('company', 'categories101'));
    }
}
