<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController
{
    // Show all testimonials
    public function index()
    {
        $mdata = Category::all();
        return view('admin.category.index', compact('mdata'));
    }

    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = $category->status == 1 ? 0 : 1;
        $category->save();
        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    // Show form to create a testimonial
    public function create()
    {
        return view('admin.category.create');
    }

    // Store a new testimonial
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'icon' => 'required|max:255',
        ]);
    
        Category::create([
            'name'        => $request->name,
            'icon'            => $request->icon,
            'status'          => 1,
            'open_positions'  => 0,
        ]);
    
        // Return success response for AJAX
        return response()->json([
            'message' => 'Category created successfully!',
            'redirect_url' => route('category.index')
        ]);
    }
    
    // Show form to edit a testimonial
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.category.edit', compact('data'));
    }

    // Update a testimonial
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|max:255',
            'icon'    => 'required|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->icon = $request->input('icon');
        $category->save();

        return response()->json([
            'message' => 'Category updated successfully!',
            'redirect_url' => route('category.index')
        ]);
    }

    // Delete a testimonial
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')
        ->with('success', 'Category deleted successfully.');
    }
}
