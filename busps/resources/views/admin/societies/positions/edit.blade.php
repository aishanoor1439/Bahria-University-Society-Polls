@extends('layouts.panel')

@section('title', 'Edit Position')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Edit Position: {{ $position->position_name }}</h4>
            <div class="pull-right">
                <a href="{{ route('societies.show', $society->society_id) }}" class="btn btn-default">
                    <i class="fas fa-arrow-left"></i> Back to Society
                </a>
            </div>
        </div>
        <div class="content">
            <form method="POST" action="{{ route('positions.update', [$society->society_id, $position->position_id]) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="position_name">Position Name</label>
                    <input type="text" class="form-control" id="position_name" name="position_name" 
                           value="{{ old('position_name', $position->position_name) }}" required>
                </div>

                <!-- Add other form fields as needed -->

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Position
                </button>
            </form>
        </div>
    </div>
</div>
@endsection