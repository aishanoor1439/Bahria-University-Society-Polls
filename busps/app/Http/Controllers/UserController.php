<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegister()
    {
        return view('user.register');
    }

    public function showLogin()
    {
        return view('user.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:320|unique:students',
            'password' => 'required|string|min:8|max:25',
        ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registration Successful!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $studentInfo = Student::where('email', $request->input('email'))->first();

        if (!$studentInfo || !Hash::check($request->input('password'), $studentInfo->password)) {
            return back()->withInput()->withErrors(['email' => 'Invalid credentials!']);
        }

        Auth::guard('student')->login($studentInfo);

        return redirect()->route('user.dashboard');
    }

    public function showDashboard()
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the dashboard.');
        }

        $LoggedStudentInfo = Auth::guard('student')->user();
        return view('user.dashboard', ['LoggedStudentInfo' => $LoggedStudentInfo]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/user/login');
    }
}
