<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply 'auth' middleware only to these methods
        $this->middleware('auth')->only(['changePassword', 'index', 'appliedUsers']);
    }

    public function registerSave(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'required',
            'phone'    => 'required',
            'role'  => 'in:candidate,company',
        ]);

        $user = User::create(attributes: [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'  => $request->profile ?? 'admin',
        ]);

        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
        } else {
            return back()->with('error', 'Registration failed, please try again.');
        }
    }


    public function login()
    {
        return view('frontside.auth.login');
    }

    public function loginSave(Request $request)
    {
        $request->merge([
            'profile' => $request->input('profile', 'admin')
        ]);

        $request->validate([
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);
        
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        // Check if 'remember' checkbox is checked
        $remember = $request->has('remember');

        // Pass $remember into Auth::attempt
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->role !== $request->profile) {
                Auth::logout(); // Profile mismatch
                return back()->with('error', 'Incorrect profile selected for this account.');
            }

            switch ($user->role) {
                case 'candidate':
                    return redirect()->route('candidate.detail')->with('success', 'Welcome Candidate!');
                case 'company':
                    return redirect()->route('company.detail')->with('success', 'Welcome Company!');
                case 'admin':
                    return redirect()->route('admin.index')->with('success', 'Welcome Admin!');
                default:
                    Auth::logout();
                    return back()->with('error', 'Unauthorized profile.');
            }
        }

        return back()->with('error', 'Login failed. Please check your email and password.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontside.home');
    }


    public function changePassword()
    {
        return view('frontside.auth.change_password');
    }

    public function changePasswordSubmit(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function forgetPw(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function index()
    {
        $allUsers = User::whereIn('role', ['candidate', 'company'])->get();
        return view('admin.user.index', compact('allUsers'));
    }

    public function appliedUsers()
    {
        $allUsers = Candidate::whereHas('applications')->with('user')->get();
        return view('admin.user.applied_users', compact('allUsers'));
    }

    public function userDetails($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.profile_detail', compact('user'));
    }

    public function appliedUserDetails($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.applied_user_detail', compact('user'));
    }
}
