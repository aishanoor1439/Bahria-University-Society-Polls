<?php
namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\Student;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocietyMemberController extends Controller
{
    public function index(Society $society)
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

        $nonMembers = DB::table('students')
            ->whereNotIn('student_id', function ($query) use ($society) {
                $query->select('student_id')
                    ->from('student_societies')
                    ->where('society_id', $society->society_id);
            })
            ->get();

        return view('admin.societies.members.index', compact('society', 'members', 'positions', 'nonMembers'));
    }

    public function store(Request $request, Society $society)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'position_id' => 'nullable|exists:positions,position_id'
        ]);

        $society->members()->attach($request->student_id, [
            'position_id' => $request->position_id
        ]);

        return back()->with('success', 'Member added successfully');
    }

    public function update(Request $request, Society $society, Student $student)
    {
        $request->validate([
            'position_id' => 'nullable|exists:positions,position_id'
        ]);

        $society->members()->updateExistingPivot($student->student_id, [
            'position_id' => $request->position_id
        ]);

        return back()->with('success', 'Position updated successfully');
    }

    public function destroy(Society $society, Student $student)
    {
        $society->members()->detach($student->student_id);
        return back()->with('success', 'Member removed successfully');
    }
}
