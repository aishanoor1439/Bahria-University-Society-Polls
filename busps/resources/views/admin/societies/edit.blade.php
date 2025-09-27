@extends('layouts.panel')

@section('title', 'Manage Societies')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h5 class="card-title mb-0 d-flex align-items-center">Edit Society</h5>
        </div>
        <div class="content">
            <form method="POST" action="{{ route('societies.update', $society->society_id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="society_name">Society Name</label>
                    <input type="text" class="form-control" id="society_name" name="society_name" value="{{ $society->society_name }}" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $society->description }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary gradient-custom-2 w-100 fw-bold fa-md">Update Society</button>
                <a href="{{ route('societies.index') }}" class="btn btn-custom">Cancel</a>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
@endsection