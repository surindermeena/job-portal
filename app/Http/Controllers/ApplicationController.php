<?php

namespace App\Http\Controllers;

use App\Models\Application;

class ApplicationController
{
    public function index()
    {
        $mdata = Application::with(['candidate.user', 'job'])->get();
        return view('admin.application.index', compact('mdata'));
    }
}
