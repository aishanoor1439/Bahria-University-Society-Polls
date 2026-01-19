{{-- resources/views/admin/societies/create.blade.php --}}
@extends('layouts.panel')

@section('title', 'Create Society')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h5 class="card-title mb-0 d-flex align-items-center">Create New Society</h5>
        </div>
        <div class="content">
            <form method="POST" action="{{ route('societies.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="society_name">Society Name</label>
                    <input type="text" class="form-control" id="society_name" name="society_name" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary gradient-custom-2 w-100 fw-bold fa-md">Create Society</button>
                <a href="{{ route('societies.index') }}" class="btn btn-custom">Cancel</a>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
@endsection