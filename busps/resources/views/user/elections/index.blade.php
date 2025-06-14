@extends('layouts.user-panel')

@section('title', 'Society Elections')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="title">
                    {{ $society->society_name }}
                </h4>
                <a href="{{ route('student.elections.societies.index') }}" class="btn btn-custom">
                    <i class="fas fa-arrow-left me-1"></i> Back to Societies
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

            @if($elections->count() > 0)
                @foreach($elections as $election)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <i class="fas fa-vote-yea me-2"></i><h5 class="card-title">{{ $election->election_name }}</h5>
                                <p class="card-text text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ \Carbon\Carbon::parse($election->start_date)->format('M d, Y H:i') }} to
                                    {{ \Carbon\Carbon::parse($election->end_date)->format('M d, Y H:i') }}
                                </p>
                                <p class="small">
                                    Status: {{ $election->is_active ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('student.elections.vote', ['election' => $election->election_id]) }}" class="btn btn-manage">
                                    <i class="fas fa-hand-paper me-1"></i> Vote
                                </a>
                                <a href="{{ route('student.elections.apply', ['election' => $election->election_id]) }}" class="btn btn-manage">
                                    <i class="fas fa-user-tie me-1"></i> Apply
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No elections found for this society at the moment.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection