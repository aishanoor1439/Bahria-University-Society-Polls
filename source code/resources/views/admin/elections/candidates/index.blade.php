@extends('layouts.panel')

@section('title', 'Manage Election Candidates')

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
            <h5 class="mb-3 mt-4">Pending Applications</h5>
            <table class="table table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>AI Suggestion</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications->where('status', 'pending') as $application)
                    <tr>
                        <td>{{ $application->student->name }}</td>
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
                        <td>
                            <button onclick="getAIRecommendation(
                                '{{ addslashes($application->student->name) }}', 
                                '{{ addslashes($application->student->current_position ?? 'No Position') }}', 
                                '{{ addslashes($election->election_name) }}'
                            )" class="btn btn-sm btn-info">
                                <i class="fas fa-robot"></i> Get AI Suggestion
                            </button>
                            <div class="ai-recommendation mt-2"></div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No pending applications.</td> <!-- Updated colspan -->
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <h5 class="mb-3">Approved Candidates</h5>
            <table class="table table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($election->candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->student->name }}</td>
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
            <table class="table table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications->where('status', 'rejected') as $application)
                    <tr class="text-muted">
                        <td>{{ $application->student->name }}</td>
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
@section('scripts')
<script>
    async function getAIRecommendation(studentName, currentPosition, electionName) {
        const btn = event.target;
        const recommendationBox = btn.closest('td').querySelector('.ai-recommendation');

        try {
            // Show loading state
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Analyzing';
            recommendationBox.innerHTML = '<div class="text-muted">Processing...</div>';

            // Get CSRF token safely
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            const response = await fetch('/api/ai-recommend', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    student_name: studentName,
                    current_position: currentPosition,
                    election_name: electionName
                })
            });

            if (!response.ok) {
                throw new Error(`API request failed with status ${response.status}`);
            }

            const data = await response.json();

            recommendationBox.innerHTML = `
            <div class="alert alert-${data.recommendation === 'approve' ? 'success' : 'danger'} p-2">
                <strong>${data.recommendation.toUpperCase()}</strong> 
                (${Math.round(data.confidence)}% confidence)
                <br><small>${data.reason}</small>
            </div>
        `;
        } catch (error) {
            console.error('Recommendation error:', error);
            recommendationBox.innerHTML = `
            <div class="alert alert-warning p-2">
                <i class="fas fa-exclamation-triangle"></i> 
                ${error.message || 'Failed to load recommendation'}
            </div>
        `;
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-robot"></i> Get AI Suggestion';
        }
    }
</script>
@endsection