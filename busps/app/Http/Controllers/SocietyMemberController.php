<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\Student;
use App\Models\Position;
use Illuminate\Http\Request;

class SocietyMemberController extends Controller
{
    public function index(Society $society)
    {
        // Get all members with their position information
        $members = $society->students()
                    ->withPivot('position_id')
                    ->with(['societies' => function($q) use ($society) {
                        $q->where('society_id', $society->society_id);
                    }])
                    ->get();

        $positions = $society->positions;
        
        // Get students not in this society
        $nonMembers = Student::whereDoesntHave('societies', function($q) use ($society) {
                        $q->where('society_id', $society->society_id);
                    })->get();

        return view('admin.societies.members.index', compact('society', 'members', 'positions', 'nonMembers'));
    }

    public function store(Request $request, Society $society)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'position_id' => 'nullable|exists:positions,position_id'
        ]);

        // Attach student to society with position
        $society->students()->attach($request->student_id, [
            'position_id' => $request->position_id
        ]);

        return back()->with('success', 'Member added successfully');
    }

    public function update(Request $request, Society $society, Student $student)
    {
        $request->validate([
            'position_id' => 'nullable|exists:positions,position_id'
        ]);

        // Update pivot table record
        $society->students()->updateExistingPivot($student->student_id, [
            'position_id' => $request->position_id
        ]);

        return back()->with('success', 'Position updated successfully');
    }

    public function destroy(Society $society, Student $student)
    {
        // Remove student from society
        $society->students()->detach($student->student_id);
        
        return back()->with('success', 'Member removed successfully');
    }
}