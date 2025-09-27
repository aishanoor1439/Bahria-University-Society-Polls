@extends('layouts.user-panel')

@section('title', 'My Societies')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i class="fas fa-user-friends me-2"></i>You are a member of
                </h5>
                @if(!$societies->isEmpty())
                <span class="badge">
                    {{ $societies->count() }} societies
                </span>
                @endif
            </div>
        </div>

        <div class="content">
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            @endif

            @forelse($societies as $society)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title">
                                <a href="{{ route('student.societies.show', $society) }}">
                                    {{ $society->society_name }}
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                <i class="fas fa-align-left me-2"></i>{{ Str::limit($society->description, 25) }}
                            </p>
                        </div>
                        <span class="badge bg-secondary">
                            <i class="fas fa-user me-1"></i>{{ $society->members_count }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> You haven't joined any societies yet.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection