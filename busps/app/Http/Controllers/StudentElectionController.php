<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Application;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


    public function showElections(Society $society)
    {
        $elections = DB::table('elections')
            ->where('society_id', $society->society_id)
            ->get();

        return view('user.elections.index', compact('society', 'elections'));
    }


    public function showVoteForm(Election $election)
    {
        $studentId = Auth::guard('student')->id();
        $electionId = $election->election_id;

        $canVote = $this->canVote($studentId, $electionId);
        if (!$canVote['can_vote']) {
            return back()->with('error', $canVote['message']);
        }

        $candidates = Candidate::where('election_id', $electionId)
            ->with('student')
            ->get();

        return view('user.elections.vote', compact('election', 'candidates'));
    }

    public function submitVote(Request $request, Election $election)
    {

        $studentId = Auth::guard('student')->id();
        $candidateId = $request->input('candidate_id');
        $electionId = $election->election_id;

        // dd($request->all());

        $canVote = $this->canVote($studentId, $electionId);
        if (!$canVote['can_vote']) {
            return back()->with('error', $canVote['message']);
        }

        $candidate = Candidate::where('election_id', $electionId)
            ->where('candidate_id', $candidateId)
            ->first();

        if (!$candidate) {
            return back()->with('error', 'Invalid candidate selected');
        }

        // Record the vote
        Vote::create([
            'voter_id' => $studentId,
            'election_id' => $electionId,
            'candidate_id' => $candidateId,
        ]);

        return redirect()->route('student.election.societies.elections', $election->society_id)
            ->with('success', 'Your vote has been submitted successfully!');
    }

    public function showApplicationForm(Election $election)
    {
        $studentId = Auth::guard('student')->id();

        $canApply = $this->canApply($studentId, $election->id);
        if (!$canApply['can_apply']) {
            return back()->with('error', $canApply['message']);
        }

        return view('user.elections.apply', compact('election'));
    }

    public function submitApplication(Request $request, Election $election)
    {
        $studentId = Auth::guard('student')->id();
        $electionId = $election->election_id;

        $canApply = $this->canApply($studentId, $electionId);
        if (!$canApply['can_apply']) {
            return back()->with('error', $canApply['message']);
        }

        $request->validate([
            'manifesto' => 'required|string|max:2000',
        ]);

        $existingApplication = Application::where('student_id', $studentId)
            ->where('election_id', $electionId)
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this election');
        }

        Application::create([
            'student_id' => $studentId,
            'election_id' => $electionId,
            'status' => 'pending',
            'note' => $request->input('manifesto'),
        ]);

        return redirect()->route('student.elections.societies.elections', $election->society_id)
            ->with('success', 'Your application has been submitted for review!');
    }

    // Helper methods
    private function canVote($studentId, $electionId)
    {
        // Check if already voted
        $alreadyVoted = Vote::where('voter_id', $studentId)
            ->where('election_id', $electionId)
            ->exists();

        if ($alreadyVoted) {
            return ['can_vote' => false, 'message' => 'You have already voted in this election'];
        }

        // Check if is candidate
        $isCandidate = Candidate::where('student_id', $studentId)
            ->where('election_id', $electionId)
            ->exists();

        if ($isCandidate) {
            return ['can_vote' => false, 'message' => 'Candidates cannot vote in their own election'];
        }

        return ['can_vote' => true, 'message' => ''];
    }

    private function canApply($studentId, $electionId)
    {
        // Check if already a candidate
        $isCandidate = Candidate::where('student_id', $studentId)
            ->where('election_id', $electionId)
            ->exists();

        if ($isCandidate) {
            return ['can_apply' => false, 'message' => 'You are already a candidate in this election'];
        }

        // Check if already applied
        $hasPendingApplication = Application::where('student_id', $studentId)
            ->where('election_id', $electionId)
            ->where('status', 'pending')
            ->exists();

        if ($hasPendingApplication) {
            return ['can_apply' => false, 'message' => 'You already have a pending application for this election'];
        }

        return ['can_apply' => true, 'message' => ''];
    }
}
