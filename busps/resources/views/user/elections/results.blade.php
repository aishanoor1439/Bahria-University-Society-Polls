@extends('layouts.user-panel')

@section('title', 'Election Results')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('student.elections.societies.elections', $election->society_id) }}" class="btn btn-custom">
                    <i class="fas fa-arrow-left me-1"></i> Back to Elections
                </a>
            </div>
            <div class="text-center mb-4">
                <h3 class="title">{{ $election->election_name }}</h3>
                <h4 class="title">{{ $election->society->society_name }}</h4>
                <p>
                <div class="text-muted">
                    <i class="fas fa-calendar-alt me-2 text-muted"></i>
                    {{ \Carbon\Carbon::parse($election->start_date)->format('M d, Y H:i') }} to
                    {{ \Carbon\Carbon::parse($election->end_date)->format('M d, Y H:i') }}
                </div>
                </p>
                @php
                $totalVotes = $candidates->sum('vote_count');
                @endphp
                @if($totalVotes > 0)
                <div class="mt-4">
                    <h5 class="card-title">Winner: {{ $candidates->first()->student->name }}</h5>
                </div>
                @else
                <div class="mt-4 alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No votes have been cast in this election yet.
                </div>
                @endif
            </div>
        </div>

        <div class="content">
            @if($candidates->isEmpty())
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i> There are no candidates in this election.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Candidate Name</th>
                                <th>Votes</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)
                            <tr>
                                <td>{{ $candidate->student->name }}</td>
                                <td>{{ $candidate->vote_count }}</td>
                                <td>
                                    @if($totalVotes > 0)
                                        {{ round(($candidate->vote_count / $totalVotes) * 100, 2) }}%
                                    @else
                                        0%
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection