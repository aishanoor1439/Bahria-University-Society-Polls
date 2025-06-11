@extends('layouts.panel')

@section('title', 'Create Election')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Create New Election</h4>
            <div class="pull-right">
                <a href="{{ route('admin.elections.index') }}" class="btn btn-default">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
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

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Create Election
                </button>
            </form>
        </div>
    </div>
</div>
@endsection