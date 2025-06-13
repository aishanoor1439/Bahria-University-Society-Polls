<?php

namespace App\Http\Controllers;

use App\Models\Society;
use Illuminate\Support\Facades\Auth;

class StudentElectionController extends Controller
{
    public function index()
    {
        $studentId = Auth::guard('student')->id();

        if (!$studentId) {
            return redirect('user/login')->with('error', 'Please login first!');
        }

        $societies = Society::whereHas('members', function ($query) use ($studentId) {
            $query->where('student_societies.student_id', $studentId);
        })
            ->withCount('members')
            ->get();

        return view('user.societies.index02', compact('societies'));
    }
}
