@extends('layouts.user-panel')

@section('title', 'Vote in Election')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="title">
                    <i class="fas fa-hand-paper me-2"></i>{{ $election->election_name }}
                </h4>
                <a href="{{ route('student.elections.societies.elections', $election->society_id) }}" class="btn btn-custom">
                    <i class="fas fa-arrow-left me-1"></i> Back to Elections
                </a>
            </div>
        </div>

        <div class="content">
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            @endif

            @if($candidates->isEmpty())
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>No candidates available for this election yet.
            </div>
            @else
            <form method="POST" action="{{ route('student.elections.vote.submit', $election) }}">
                @csrf
                <div class="row">
                    @foreach($candidates as $candidate)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="candidate_id" 
                                           id="candidate{{ $candidate->id }}"value="{{ $candidate->candidate_id }}" required>
                                    <label class="form-check-label" for="candidate{{ $candidate->id }}">
                                        <h5>{{ $candidate->student->name }}</h5>
                                        @if($candidate->manifesto)
                                        <p class="text-muted">{{ Str::limit($candidate->manifesto, 150) }}</p>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary gradient-custom-2 w-100 fw-bold fa-md">
                    <i class="fas fa-paper-plane me-1"></i> Submit Vote
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection