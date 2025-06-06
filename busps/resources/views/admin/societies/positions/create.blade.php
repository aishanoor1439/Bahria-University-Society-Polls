@extends('layouts.panel')

@section('title', 'Add New Position')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Add New Position to {{ $society->society_name }}</h4>
            <div class="pull-right">
                <a href="{{ route('societies.show', $society->society_id) }}" class="btn btn-default">
                    <i class="fas fa-arrow-left"></i> Back to Society
                </a>
            </div>
        </div>
        <div class="content">
            <form method="POST" action="{{ route('positions.store', $society->society_id) }}">
                @csrf
                
                <div class="form-group">
                    <label for="position_name">Position Name</label>
                    <input type="text" class="form-control" id="position_name" name="position_name" 
                           value="{{ old('position_name') }}" required>
                    @error('position_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Add other form fields as needed -->

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Create Position
                </button>
            </form>
        </div>
    </div>
</div>
@endsection