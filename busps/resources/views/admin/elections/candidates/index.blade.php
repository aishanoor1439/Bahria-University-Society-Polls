@extends('layouts.panel')

@section('title', 'Manage Election Candidates')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">{{ $election->election_name }}</h4>
            <a href="{{ route('admin.elections.index') }}" class="btn btn-custom">
                <i class="fas fa-arrow-left"></i> Back to Elections
            </a>
        </div>

        <div class="content table-responsive">

            <h5 class="mb-3 mt-4">Pending Applications</h5>
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th>Student</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications->where('status', 'pending') as $application)
                    <tr>
                        <td>{{ $application->student->name }}</td>
                        <td>{{ $application->student->current_position ?? 'No Position' }}</td>
                        <td>Pending</td>
                        <td>
                            <form action="{{ route('admin.elections.candidates.approve', [$election->election_id, $application->application_id]) }}" method="POST" class="d-inline-block">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.elections.candidates.reject', [$election->election_id, $application->application_id]) }}" method="POST" class="d-inline-block">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No pending applications.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <h5 class="mb-3">Approved Candidates</h5>
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th>Student</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($election->candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->student->name }}</td>
                        <td>{{ $candidate->student->current_position ?? 'No Position' }}</td>
                        <td>Approved</td>
                        <td>
                            <form action="{{ route('admin.elections.candidates.remove', [$election->election_id, $candidate->candidate_id]) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this candidate?')">
                                    <i class="fas fa-user-minus"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No approved candidates yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <h5 class="mb-3 mt-4">Rejected Applications</h5>
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th>Student</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications->where('status', 'rejected') as $application)
                    <tr class="text-muted">
                        <td>{{ $application->student->name }}</td>
                        <td>{{ $application->student->current_position ?? 'No Position' }}</td>
                        <td>Rejected</td>
                        <td>
                            <form action="{{ route('admin.elections.candidates.reconsider', [$election->election_id, $application->application_id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fas fa-redo"></i> Reconsider
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No rejected applications.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection