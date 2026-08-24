<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Job;
use App\Models\User;
use App\Models\AboutUs;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\TermCondition;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CommonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['adminChangePassword' . 'adminProfileEdit']);
    }


    public function index()
    {
        $reviews = Testimonial::where('status', '=', 1)->get();
        $jobs = Job::with(['company', 'category', 'types', 'skills', 'qualifications'])->where('featured', 1)->limit(3)->get();
        $category = Category::where('status', 1)
            ->withCount(['jobs as open_positions'])
            ->get();
        $jobsAddedToday = Job::whereDate('created_at', Carbon::today())->count();
        return view('frontside.index', compact('reviews', 'jobs', 'category', 'jobsAddedToday'));
    }

    public function about()
    {
        $alldata = AboutUs::with(['socialLinks', 'services'])->first();
        $reviews = Testimonial::where('status', '=', 1)->get();

        $stats = [
            [
                'count' => Category::count(),
                'label' => 'Jobs Posted',
            ],
            [
                'count' => Category::count(),
                'label' => 'Job Category',
            ],
            [
                'count' => Company::count(),
                'label' => 'Companies',
            ],
            [
                'count' => User::count(),
                'label' => 'Candidates',
            ],
        ];

        return view('frontside.about', compact('alldata', 'reviews', 'stats'));
    }

    public function faq()
    {
        $alldata = Faq::where('status', '=', 1)->get();
        return view('frontside.faq', compact('alldata'));
    }

    public function terms()
    {
        $alldata = TermCondition::where('status', '=', 1)->get();
        return view('frontside.term_and_condition', compact('alldata'));
    }

    public function companies(Request $request)
{
    $specialisms = Category::all();
    $query = Company::with(['categories'])
                    ->withCount('jobs')
                    ->where('status', 1);

    // Filter by city (exact match or partial, choose your logic)
    if ($request->filled('city')) {
        $query->where('city', 'like', '%' . $request->city . '%');
    }

    // Filter by specialism (category names)
    if ($request->filled('specialism')) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->whereIn('name', $request->specialism);
        });
    }

    // Team size ranges mapping
    $teamSizeRanges = [
        '1 - 25'    => [1, 25],
        '26 - 50'   => [26, 50],
        '51 - 75'   => [51, 75],
        '76 - 100'  => [76, 100],
        '101 - 125' => [101, 125],
        '126 - 150' => [126, 150],
    ];

    // Filter by team size ranges (multiple selections possible)
    if ($request->filled('team_size')) {
        $query->where(function ($q) use ($request, $teamSizeRanges) {
            foreach ($request->team_size as $range) {
                if (isset($teamSizeRanges[$range])) {
                    [$min, $max] = $teamSizeRanges[$range];
                    $q->orWhereBetween('team_size', [$min, $max]);
                }
            }
        });
    }

    // Pagination
    $perPage = $request->get('per_page', 6);
    $data = $query->paginate($perPage)->appends($request->query());

    return view('frontside.companies', compact('data','specialisms'));
}



    // public function companies(Request $request)
    // {
    //     $query = Company::with(['categories'])->withCount('jobs')
    //         ->where('status', 1);

        

    //     // Specialism (Categories)
    //     if ($request->filled('specialism')) {
    //         $query->whereHas('categories', function ($q) use ($request) {
    //             $q->whereIn('category_id', $request->specialism);
    //         });
    //     }

    //     // Team size (assuming team_size is stored as a number)
    //     $teamSizeRanges = [
    //         '1 - 25'    => [1, 25],
    //         '26 - 50'   => [26, 50],
    //         '51 - 75'   => [51, 75],
    //         '76 - 100'  => [76, 100],
    //         '101 - 125' => [101, 125],
    //         '126 - 150' => [126, 150],
    //     ];

    //     if ($request->filled('team_size')) {
    //         $query->where(function ($q) use ($request, $teamSizeRanges) {
    //             foreach ($request->team_size as $range) {
    //                 if (isset($teamSizeRanges[$range])) {
    //                     [$min, $max] = $teamSizeRanges[$range];
    //                     $q->orWhereBetween('team_size', [$min, $max]);
    //                 }
    //             }
    //         });
    //     }

    //     // Pagination
    //     $perPage = $request->get('per_page', 6);
    //     $data = $query->paginate($perPage)  ->appends($request->query());

    //     return view('frontside.companies', compact('data'));
    // }

    public function contact()
    {
        $alldata = DB::table('settings')->get();
        return view('frontside.contact_us', compact('alldata'));
    }

    public function howItWork()
    {
        $alldata = DB::table('how_it_works')->get();
        return view('frontside.how_it_works', compact('alldata'));
    }


    public function jobs(Request $request)
    {
        // Start with only active jobs and load company + user
        $query = Job::with('company.user')->where('status', 1);

        // Keyword search (Job title or Company name)
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');

            $query->where(function ($q) use ($keyword) {
                $q->where('job_title', 'like', "%$keyword%")
                    ->orWhereHas('company', function ($companyQuery) use ($keyword) {
                        $companyQuery->where('company_name', 'like', "%$keyword%");
                    });
            });
        }

        // City filter
        if ($request->filled('location')) {
            $city = $request->input('location');

            $query->whereHas('company', function ($companyQuery) use ($city) {
                $companyQuery->where('city', 'like', "%$city%");
            });
        }

        // Paginate results (30 per page)
        $jobs = $query->orderBy('created_at', 'desc')
            ->paginate(30)
            ->appends($request->query());

        return view('frontside.jobs', ['data' => $jobs]);
    }


    public function jobByCity(string $city)
    {
        $jobs = Job::whereHas('company', function ($query) use ($city) {
            $query->where('city', $city);
        })->paginate(10);

        return view('frontside.jobs_by_city', ['data' => $jobs, 'titleCity' => $city]);
    }

    public function jobByCat(string $cat)
    {
        $jobs = Job::whereHas('category', function ($query) use ($cat) {
            $query->where('name', $cat);   // or 'slug' if you're storing slugs
        })->paginate(10);
        return view('frontside.jobs_by_cat', ['data' => $jobs, 'titleCat' => $cat]);
    }


    public function singleCompany($id)
    {
        $data = Company::with(['categories', 'jobs', 'skills', 'socialLinks'])->findOrFail($id);
        $alldata = Company::with(['categories', 'jobs', 'skills', 'socialLinks'])->where('company_name', $data->company_name)->get();
        return view('frontside.single_company_detail', compact('data', 'alldata'));
    }

    public function singleJob($id)
    {
        $data = Job::with(['company', 'category', 'types', 'skills', 'qualifications'])->findOrFail($id);
        $alldata = Company::with(['company', 'category', 'types', 'skills', 'qualifications'])->where('company_name', $data->company_name)->get();
        return view('frontside.single_job_detail', compact('data', 'alldata'));
    }

    public function adminDetail()
    {
        $user = Auth::user();
        $admin = Admin::firstOrCreate(['user_id' => $user->id]);
        return view('admin.my_profile.admin_detail', compact('admin'));
    }

    public function adminChangePassword()
    {
        return view('admin.my_profile.change_password');
    }


    public function adminProfileEdit()
    {
        $user = Auth::user();
        $admin = Admin::firstOrCreate(['user_id' => $user->id]);
        return view('admin.my_profile.admin_detail_edit', compact('admin'));
    }

    public function adminProfileUpdate(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Validate fields
        $request->validate([
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'pin' => 'nullable',
        ]);


        // Handle image upload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/resource'), $filename);
            $admin->image = $filename; 
        }

        // Handle simple text fields
        $admin->address = $request->input('address');
        $admin->city = $request->input('city');
        $admin->state = $request->input('state');
        $admin->country = $request->input('country');
        $admin->pin = $request->input('pin');

        $admin->save();

        // return redirect()->route('admin.index')->with('success', 'Profile updated successfully.');

        return response()->json([
            'status'  => 'success',
            'message' => 'Profile updated successfully.',
            'redirect_url' => route('admin.index') // send the route as data
        ]);
    }
}
