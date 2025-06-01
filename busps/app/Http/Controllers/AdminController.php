<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function showRegister()
    {
        return view('admin.register');
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:6|max:12',
        ]);

        // Create and save the admin
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Force the exact message "Registration Successful!" 
        return redirect()->route('admin.login')->with('success', 'Registration Successful!');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the admin by email
        $adminInfo = Admin::where('email', $request->input('email'))->first();

        // Check if admin exists
        if (!$adminInfo) {
            return back()->withInput()->withErrors(['email' => 'Email not found!']);
        }

        // Check if the provided password matches the hashed password
        if (!Hash::check($request->input('password'), $adminInfo->password)) {
            return back()->withInput()->withErrors(['password' => 'Incorrect Password!']);
        }

        // Store admin ID in the session
        $request->session()->put('LoggedAdminInfo', $adminInfo->id);

        // Redirect to the dashboard
        return redirect()->route('admin.dashboard');
    }

    public function showDashboard()
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
        }

        return view('admin.dashboard', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
        ]);
    }
}
