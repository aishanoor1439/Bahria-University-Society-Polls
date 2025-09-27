@extends('layouts.panel')

@section('title', 'Manage Candidates')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h5 class="card-title mb-0 d-flex align-items-center">{{ $election->election_name }}</h5>
            <a href="{{ route('admin.elections.index') }}" class="btn btn-custom">
                <i class="fas fa-arrow-left"></i> Back to Elections
            </a>
        </div>
        <div class="content table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Current Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($election->candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->student->name }}</td>
                        <td>
                            @php
                            $position = $candidate->student->societies()
                            ->whereNotNull('position_id')
                            ->first();
                            @endphp
                            {{ $position ? $position->position->position_name : 'No Position' }}
                        </td>
                        <td>
                            <span class="label label-success">
                                Approved Candidate
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.elections.candidates.remove', [$election->election_id, $candidate->candidate_id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this candidate?')">
                                    <i class="fas fa-user-minus"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @foreach($applications->where('status', 'pending') as $application)
                    <tr>
                        <td>{{ $application->student->name }}</td>
                        <td>
                            @php
                            $position = $application->student->societies()
                            ->whereNotNull('position_id')
                            ->first();
                            @endphp
                            {{ $position ? $position->position->position_name : 'No Position' }}
                        </td>
                        <td>
                            <span class="label label-warning">
                                Pending Approval
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.elections.candidates.approve', [$election->election_id, $application->application_id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.elections.candidates.reject', [$election->election_id, $application->application_id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @foreach($applications->where('status', 'rejected') as $application)
                    <tr class="text-muted">
                        <td>{{ $application->student->name }}</td>
                        <td>
                            @php
                            $position = $application->student->societies()
                            ->whereNotNull('position_id')
                            ->first();
                            @endphp
                            {{ $position ? $position->position->position_name : 'No Position' }}
                        </td>
                        <td>
                            <span class="label label-danger">
                                Rejected
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.elections.candidates.reconsider', [$election->election_id, $application->application_id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fas fa-redo"></i> Reconsider
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection