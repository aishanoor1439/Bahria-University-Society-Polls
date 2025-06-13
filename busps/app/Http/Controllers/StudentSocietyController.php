<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentSocietyController extends Controller
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

        return view('user.societies.index', compact('societies'));
    }

    public function show(Society $society)
    {
        $members = DB::table('student_societies')
            ->join('students', 'student_societies.student_id', '=', 'students.student_id')
            ->leftJoin('positions', 'student_societies.position_id', '=', 'positions.position_id')
            ->where('student_societies.society_id', $society->society_id)
            ->select(
                'students.student_id',
                'students.name',
                'students.email',
                'student_societies.position_id as pivot_position_id',
                'positions.position_name'
            )
            ->get();

        $positions = Position::where('society_id', $society->society_id)->get();

        return view('user.societies.show', compact('society', 'members', 'positions'));
    }
}
