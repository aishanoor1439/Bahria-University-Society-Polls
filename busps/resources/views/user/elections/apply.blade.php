@extends('layouts.user-panel')

@section('title', 'Apply for Election')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="title">
                    <i class="fas fa-user-tie me-2"></i>{{ $election->election_name }}
                </h4>
                    <a href="{{ route('student.elections.societies.elections', $election->society_id) }}" class="btn btn-custom">
                        <i class="fas fa-arrow-left me-1"></i> Back to Elections
                    </a>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('student.elections.apply.submit', $election) }}">
                @csrf
                <div class="form-group">
                    <label for="manifesto">Your Manifesto</label>
                    <textarea class="form-control" id="manifesto" name="manifesto" rows="5"
                        placeholder="Explain why members should vote for you..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary gradient-custom-2 w-100 fw-bold fa-md">
                    <i class="fas fa-paper-plane me-1"></i> Submit Application
                </button>
            </form>
        </div>
    </div>
</div>
@endsection