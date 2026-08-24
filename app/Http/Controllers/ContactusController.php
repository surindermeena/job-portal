<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmationMail;

class ContactusController extends Controller
{
    public function __construct()
    {
        // Apply 'auth' middleware only to these methods
        $this->middleware('auth')->only(['replyMessage']);
    }

    public function index()
    {
        $mdata = Contactus::all();
        return view('admin.contact_us.index', compact('mdata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'subject'   => 'required|string|max:255',
            'message'   => 'required|string',
        ]);

        $data = [
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'subject'   => $request->subject,
            'message'   => $request->message,
        ];

        $check =  Contactus::create($data);

         // Send confirmation to user
         Mail::to('surinder321992@gmail.com')->send(new ContactConfirmationMail($data));

        if($check){
            return back()->with(['success' => 'Your message has been sent successfully!',
            'submittedData' => $data]);
        } else {
            return back()->with('error', 'Sorry, something went wrong. Please try again.');
        }
    }

        // Delete all ContactUs Message
        public function destroyAll()
        {
            Contactus::truncate();
            return redirect()->route('admin.contactUs')
                ->with('success', 'All Message deleted successfully.');
        }

        public function destroySingle($id)
        {
            $message = Contactus::findOrFail($id);
            $message->delete();
    
            return redirect()->route('admin.contactUs')
            ->with('success', 'Message deleted successfully.');
        }

}
