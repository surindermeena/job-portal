<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function downloadCV($id)
    {
        $user = Candidate::with(['user', 'skills', 'education', 'languages'])->findOrFail($id);
        $pdf = Pdf::loadView('pdf.user_cv', compact('user'));
        return $pdf->download($user->user->name . '_CV.pdf');
    }
}
