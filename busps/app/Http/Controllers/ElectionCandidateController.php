<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Election;
use App\Models\Student;
use App\Models\StudentSociety;
use App\Models\Candidate;

class ElectionCandidateController extends Controller
{
    public function index(Election $election)
    {
        $applications = Application::with(['student', 'election'])
            ->where('election_id', $election->election_id)
            ->get()
            ->map(function ($application) {
                $position = StudentSociety::where('student_id', $application->student_id)
                    ->whereNotNull('position_id')
                    ->first();

                $application->current_position = $position ? $position->position->position_name : 'No Position';
                return $application;
            });

        return view('admin.elections.candidates.index', [
            'election' => $election,
            'applications' => $applications
        ]);
    }

    public function approve(Election $election, Application $application)
    {
        Candidate::create([
            'student_id' => $application->student_id,
            'election_id' => $election->election_id,
            'manifesto' => null
        ]);

        $application->update(['status' => 'approved']);
        $application->student->update(['is_candidate' => true]);

        return back()->with('success', 'Application approved successfully');
    }

    public function reject(Election $election, Application $application)
    {
        Candidate::where([
            'student_id' => $application->student_id,
            'election_id' => $election->election_id
        ])->delete();

        $application->update(['status' => 'rejected']);
        return back()->with('success', 'Application rejected successfully');
    }

    public function remove(Election $election, Candidate $candidate)
    {
        // Remove from candidates table
        $candidate->delete();

        // Update application status if exists
        Application::where([
            'student_id' => $candidate->student_id,
            'election_id' => $candidate->election_id
        ])->update(['status' => 'rejected']);

        return back()->with('success', 'Candidate removed successfully');
    }

    public function reconsider(Election $election, Application $application)
    {
        $application->update(['status' => 'pending']);
        return back()->with('success', 'Application reopened for consideration');
    }
}
