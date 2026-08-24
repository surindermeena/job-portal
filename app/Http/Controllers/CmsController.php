<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Models\TermCondition;

class CmsController extends Controller
{
    public function __construct()
    {
        // Apply 'auth' middleware only to these methods
        $this->middleware('auth')->only(['index']);
    }

    public function index()
    {
        $aboutData = AboutUs::with(['socialLinks', 'services'])->first();
        $faqData = Faq::all();
        $termsData = TermCondition::all();
        return view('admin.cms.index', compact('aboutData', 'faqData', 'termsData'));
    }

    public function termsUpdate(Request $request)
    {
        $request->validate([
            'terms' => 'required|array',
            'terms.*.id' => 'required',
            'terms.*.title' => 'required|string|max:255',
            'terms.*.content' => 'nullable|string',
            'terms.*.status' => 'required|string|max:50',
        ]);

        foreach ($request->input('terms') as $termInput) {
            $term = TermCondition::find($termInput['id']);
            if ($term) {
                $term->title = $termInput['title'];
                $term->content = $termInput['content'];
                $term->status = $termInput['status'];
                $term->save();
            }
        }

        return response()->json([
            'message' => 'Terms updated successfully.',
        ]);
    }

    public function faqUpdate(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'faqs' => 'required|array',
            'faqs.*.id' => 'required|integer',
            'faqs.*.question' => 'required|string|max:255',
            'faqs.*.answer' => 'required|string',
            'faqs.*.status' => 'required|string|max:50',
        ]);

        foreach ($request->input('faqs') as $faqInput) {
            $faq = Faq::find($faqInput['id']);
            if ($faq) {
                $faq->question = $faqInput['question'];
                $faq->answer = $faqInput['answer'];
                $faq->status = $faqInput['status'];
                $faq->save();
            }
        }

        return response()->json([
            'message' => 'FAQs updated successfully.',
        ]);
    }

    public function aboutUpdate(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
            'title' => 'required|string|max:255',
            'content_1' => 'nullable|string',
            'content_2' => 'nullable|string',
            'content_3' => 'nullable|string',
            'content_4' => 'nullable|string',

            'services' => 'array',
            'services.*.id' => 'nullable|integer|exists:about_services,id',
            'services.*.icon' => 'required|string',
            'services.*.title' => 'required|string',
            'services.*.description' => 'required|string',

            'social_links' => 'array',
            'social_links.*.id' => 'nullable|integer|exists:about_social_links,id',
            'social_links.*.platform' => 'required|string',
            'social_links.*.icon' => 'required|string',
            'social_links.*.url' => 'required|string',
        ]);

        $about = AboutUs::with(['services', 'socialLinks'])->findOrFail($validated['id']);


        // Update about_us main fields
        $about->update([
            'title' => $validated['title'],
            'content_1' => $validated['content_1'],
            'content_2' => $validated['content_2'],
            'content_3' => $validated['content_3'],
            'content_4' => $validated['content_4'],
        ]);

        // Update services using relationship
        foreach ($validated['services'] ?? [] as $serviceInput) {
            $service = $about->services->firstWhere('id', $serviceInput['id']);
            if ($service) {
                $service->update([
                    'icon' => $serviceInput['icon'],
                    'title' => $serviceInput['title'],
                    'description' => $serviceInput['description'],
                ]);
            }
        }

        // Update social links using relationship
        foreach ($validated['social_links'] ?? [] as $socialInput) {
            $link = $about->socialLinks->firstWhere('id', $socialInput['id']);
            if ($link) {
                $link->update([
                    'platform' => $socialInput['platform'],
                    'icon' => $socialInput['icon'],
                    'url' => $socialInput['url'],
                ]);
            }
        }

        return response()->json([
            'message' => 'About section updated successfully.',
        ]);
    }
}
