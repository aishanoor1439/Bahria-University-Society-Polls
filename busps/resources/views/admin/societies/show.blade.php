@extends('layouts.panel')

@section('title', 'View Society')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">{{ $society->society_name }}</h4>
            <div class="pull-right">
                <a href="{{ route('societies.members.index', $society->society_id) }}" class="btn btn-info">
                    <i class="fas fa-users"></i> Manage Members
                </a>
                <a href="{{ route('societies.index') }}" class="btn btn-default">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="society-details">
                        <div class="form-group">
                            <label>Description:</label>
                            <p class="description-box">{{ $society->description ?? 'No description available' }}</p>
                        </div>
                    </div>

                    <div class="positions-section mt-4">
                        <h4><i class="fas fa-users-cog"></i> Positions</h4>
                        
                        @if($positions->count() > 0)
                            <div class="list-group">
                                @foreach($positions as $position)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $position->position_name }}</span>
                                        <div>
                                            <a href="{{ route('positions.edit', [$society->society_id, $position->position_id]) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('positions.destroy', [$society->society_id, $position->position_id]) }}" 
                                                  style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Delete this position?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> No positions have been added yet.
                            </div>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('positions.create', $society->society_id) }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add New Position
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .description-box {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 4px;
        border-left: 4px solid #5bc0de;
    }
    .positions-section h4 {
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }
</style>
@endsection