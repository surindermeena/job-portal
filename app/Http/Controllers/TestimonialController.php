<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function __construct()
    {
        // Apply 'auth' middleware only to these methods
        $this->middleware('auth')->only(['create']);
    }

    // Show all testimonials
    public function index()
    {
        $mdata = Testimonial::all();
        return view('admin.testimonial.index', compact('mdata'));
    }

    public function toggleStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = $testimonial->status == 1 ? 0 : 1;
        $testimonial->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    // Show form to create a testimonial
    public function create()
    {
            return view('admin.testimonial.create');
    }

    // Store a new testimonial
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'job_post'    => 'required|max:255',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/resource'), $imageName);
            $imagePath = $imageName; // Relative path to store in DB
        }

        Testimonial::create([
            'name'        => $request->name,
            'job_post'    => $request->job_post,
            'description' => $request->description,
            'image'       => $imagePath,
            'status'      => 1,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Testimonial added successfully.',
            'redirect_url' => route('admin.testimonial') // send the route here
        ]);
    }

    // Show form to edit a testimonial
    public function edit($id)
    {
        $data = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('data'));
    }


    // Update a testimonial
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'job_post'    => 'required|max:255',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($testimonial->image && file_exists(public_path('images/resource/' . $testimonial->image))) {
                unlink(public_path('images/resource/' . $testimonial->image));
            }
        
            $image = $request->file('image');
            // Use timestamped name to avoid conflicts
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Save the image
            $image->move(public_path('images/resource'), $imageName);
            // Save the filename to the model (or DB)
            $testimonial->image = $imageName;
        }
        
        // Update other fields
        $testimonial->name        = $request->name;
        $testimonial->job_post    = $request->job_post;
        $testimonial->description = $request->description;
        $testimonial->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Testimonial updated successfully.',
            'redirect_url' => route('admin.testimonial') // send the route as data
        ]);
    }


    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonial')
        ->with('success', 'Testimonial deleted successfully.');
    }
}
