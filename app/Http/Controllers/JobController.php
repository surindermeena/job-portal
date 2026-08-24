<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        // Apply 'auth' middleware only to these methods
        $this->middleware('auth')->only(['index', 'adminCompany', 'editJob', 'jobDetail', 'createJob']);
    }


    public function index()
    {
        $userId = Auth::id();

        $alljobs = Job::with(['company', 'category', 'skills'])
        ->whereHas('company', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->get();
        
        return view('company.manage_jobs', compact('alljobs'));
    }

    public function createJob()
    {
        $categories = Category::all();
        return view('company.create_job', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'job_title' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'min_experience' => 'nullable|numeric|min:0',
            'application_deadline' => 'required|date',
            'job_type' => 'required|string',
            'job_category' => 'required', 
        ]);

        // Create Job
        $job = Job::create([
            'company_id' => Auth::user()->company->id,
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'job_category' => $request->job_category,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'min_experience' => $request->min_experience,
            'application_deadline' => $request->application_deadline,
            'updated_at' => now(),
            'status' => 1,
        ]);

        $job->types()->create([
            'type' => $request->job_type
        ]);

        // Save Skills
        $skills = collect($request->all())
            ->filter(fn($value, $key) => str_starts_with($key, 'skill'))
            ->values()
            ->filter()
            ->each(function ($skill) use ($job) {
                $job->skills()->create(['skill' => $skill]);
            });

        // Save Qualifications
        $qualifications = collect($request->all())
            ->filter(fn($value, $key) => str_starts_with($key, 'qualification'))
            ->values()
            ->filter()
            ->each(function ($qual) use ($job) {
                $job->qualifications()->create(['qualification' => $qual]);
            });

        return response()->json([
            'status' => 'success',
            'message' => 'Job created successfully.',
            'redirect_url' => route('job.manageJob'),
        ]);
    }


    public function jobDetail(string $id)
    {
        $jobData = Job::with([
            'company',
            'category',
            'applications',
            'types',
            'skills',
            'qualifications'
        ])->findOrFail($id);

        return view('company.job_detail', compact("jobData"));
    }

    public function editJob(string $id)
    {
        $jobData = Job::findOrFail($id);
        $categories = Category::all();
        return view('company.edit_job', compact("jobData","categories"));
    }

    public function update(Request $request, $id)
    {
        // Find the job or fail
        $job = Job::findOrFail($id);
    
        // Validate the request
        $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'nullable|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'min_experience' => 'nullable|integer|min:0',
            'application_deadline' => 'nullable|date',
            'job_type' => 'required|string',
            'job_category' => 'required',
        ]);
    
        // Update main job fields
        $job->update([
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'job_category' => $request->job_category,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'min_experience' => $request->min_experience,
            'application_deadline' => $request->application_deadline,
            'updated_at' => now(),
        ]);
    
        // Update Job Type (1-to-1)
        $job->types()->delete(); // Remove old type
        $job->types()->create(['type' => $request->job_type]);
    
        // Update Skills (1-to-many)
        $job->skills()->delete(); // Remove old
        collect($request->all())
            ->filter(fn($val, $key) => str_starts_with($key, 'skill'))
            ->values()
            ->filter()
            ->each(fn($skill) => $job->skills()->create(['skill' => $skill]));
    
        // Update Qualifications (1-to-many)
        $job->qualifications()->delete(); // Remove old
        collect($request->all())
            ->filter(fn($val, $key) => str_starts_with($key, 'qualification'))
            ->values()
            ->filter()
            ->each(fn($qual) => $job->qualifications()->create(['qualification' => $qual]));
    
        // Return response
        return response()->json([
            'status'  => 'success',
            'message' => 'Job updated successfully.',
            'redirect_url' => route('job.manageJob')
        ]);
    }

    public function toggleStatus($id)
    {
        $job = Job::findOrFail($id);
        $job->status = $job->status == 1 ? 0 : 1;
        $job->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }


    public function adminCompany()
    {
        $company = Company::all();
        return view('admin.company.index', compact('company'));
    }

    public function companyToggleStatus($id)
    {
        $company = Company::findOrFail($id);
        $company->status = $company->status == 1 ? 0 : 1;
        $company->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('job.manageJob')->with('success', 'Job deleted successfully.');
    }
}
