@extends('layouts.panel')

@section('title', 'Add New Position')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h5 class="card-title mb-0 d-flex align-items-center">{{ $society->society_name }}</h5>
            <div class="pull-right">
                <a href="{{ route('societies.show', $society->society_id) }}" class="btn btn-custom">
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
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Create Position
                </button>
            </form>
        </div>
    </div>
</div>
@endsection