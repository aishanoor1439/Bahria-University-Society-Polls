@extends('layouts.panel')

@section('title', 'Manage Elections')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h5 class="card-title mb-0 d-flex align-items-center">Schedualed Elections</h5>
            <p class="category">Manage all elections</p>
        </div>
        @if($elections->isEmpty())
        <div class="alert alert-danger">
            <i class="fas fa-info-circle"></i> No elections have been added yet.
        </div>
        @else
        <div class="content table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Society</th>
                        <th>Year</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elections as $election)
                    <tr>
                        <td>{{ $election->election_name }}</td>
                        <td>{{ $election->society->society_name }}</td>
                        <td>{{ $election->election_year }}</td>
                        <td>{{ $election->start_date->format('d M Y') }}</td>
                        <td>{{ $election->end_date->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('admin.elections.toggle-active', $election->election_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-{{ $election->is_active ? 'success' : 'warning' }}">
                                    {{ $election->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.elections.candidates.index', $election->election_id) }}" class="btn btn-manage">
                                <i class="fas fa-users"></i> Manage candidates
                            </a>
                            <a href="{{ route('admin.elections.edit', $election->election_id) }}" class="btn btn-xs btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.elections.destroy', $election->election_id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this election?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <a href="{{ route('admin.elections.create') }}" class="btn btn-primary gradient-custom-2 w-100 fw-bold fa-md">
                Add New Election
            </a>
        </div>
    </div>
</div>
@endsection