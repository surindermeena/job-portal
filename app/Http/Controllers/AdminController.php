<?php

namespace App\Http\Controllers;

use App\Models\Category;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['createCompany']);
    }

    public function createCompany()
    {
        $categories = Category::all();

        return view('admin.company.create', compact('categories'));
    }
}
