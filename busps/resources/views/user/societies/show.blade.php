@extends('layouts.user-panel')

@section('title', 'Society Details')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="title">
                    {{ $society->society_name }}
                </h4>
                <p class="text-muted">{{ $society->description }}</p>
                <div class="pull-right">
                    <a href="{{ route('student.societies.index') }}" class="btn btn-custom">
                        <i class="fas fa-arrow-left me-1"></i> Back to Societies
                    </a>
                </div>
            </div>
        </div>

        <div class="content">
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">
                                <i class="fas fa-id-card me-2"></i>Members
                            </h4>
                        </div>
                        <div class="content">
                            @if($members->isEmpty())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> No members found
                            </div>
                            @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th><i class="fas fa-user me-1"></i> Name</th>
                                            <th><i class="fas fa-user-tag me-1"></i> Position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $member)
                                        <tr>
                                            <td>{{ $member->name }}</td>
                                            <td>
                                                {{ $member->position_name ?? 'Member' }}
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
            </div>
        </div>
    </div>
</div>
@endsection