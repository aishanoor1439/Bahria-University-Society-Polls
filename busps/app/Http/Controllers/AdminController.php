<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Society;
use App\Models\Election;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Vote;


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
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:320|unique:admin',
            'password' => 'required|string|min:8|max:25',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Registration Successful!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $adminInfo = Admin::where('email', $request->input('email'))->first();

        if (!$adminInfo) {
            return back()->withInput()->withErrors(['email' => 'Email not found!']);
        }

        if (!Hash::check($request->input('password'), $adminInfo->password)) {
            return back()->withInput()->withErrors(['password' => 'Incorrect Password!']);
        }

        $request->session()->put('LoggedAdminInfo', $adminInfo->id);

        return redirect()->route('admin.dashboard');
    }

    // public function showDashboard()
    // {
    //     $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

    //     if (!$LoggedAdminInfo) {
    //         return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard.');
    //     }

    //     return view('admin.dashboard', [
    //         'LoggedAdminInfo' => $LoggedAdminInfo,
    //     ]);
    // }

    public function showDashboard()
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard.');
        }

        // Stats
        $totalStudents = Student::count();
        $totalSocieties = Society::count();
        $totalElections = Election::count();
        $totalApplications = Application::count();
        $totalCandidates = Candidate::count();
        $totalVotes = Vote::count();

        // Applications breakdown
        $applicationStats = [
            'pending' => Application::pending()->count(),
            'approved' => Application::approved()->count(),
            'rejected' => Application::rejected()->count(),
        ];

        // Votes per candidate
        $votesPerCandidate = Candidate::with('student')->withCount('votes')->get();

        // Active elections per society
        $activeElectionsPerSociety = Society::withCount(['elections as active_elections_count' => function ($query) {
            $query->active();
        }])->get();

        // Recent Applications
        $recentApplications = Application::with(['student', 'election'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'LoggedAdminInfo',
            'totalStudents',
            'totalSocieties',
            'totalElections',
            'totalApplications',
            'totalCandidates',
            'totalVotes',
            'applicationStats',
            'votesPerCandidate',
            'activeElectionsPerSociety',
            'recentApplications'
        ));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }


    public function showSocieties()
    {
        return view('admin.societies');
    }
}
