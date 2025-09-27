@extends('layouts.panel')

@section('title', 'Create Election')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h5 class="card-title mb-0 d-flex align-items-center">Schedual New Election</h5>
        </div>
        <div class="content">
            <form method="POST" action="{{ route('admin.elections.store') }}">
                @csrf

                <div class="form-group">
                    <label for="society_id">Society</label>
                    <select class="form-control" id="society_id" name="society_id" required>
                        <option value="">Select Society</option>
                        @foreach($societies as $society)
                        <option value="{{ $society->society_id }}">{{ $society->society_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="election_name">Election Name</label>
                    <input type="text" class="form-control" id="election_name" name="election_name" required>
                </div>

                <div class="form-group">
                    <label for="election_year">Election Year</label>
                    <input type="number" class="form-control" id="election_year" name="election_year"
                        min="1900" max="{{ date('Y') + 1 }}" value="{{ date('Y') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary gradient-custom-2 w-100 fw-bold fa-md">Create Election</button>
                <a href="{{ route('admin.elections.index') }}" class="btn btn-custom">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection