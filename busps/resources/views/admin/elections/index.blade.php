@extends('layouts.panel')

@section('title', 'Manage Elections')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Elections</h4>
            <div class="pull-right">
                <a href="{{ route('admin.elections.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New Election
                </a>
            </div>
        </div>
        <div class="content table-responsive">
            <table class="table table-hover">
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
                                <button type="submit" class="btn btn-sm btn-{{ $election->is_active ? 'success' : 'warning' }}">
                                    {{ $election->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.elections.edit', $election->election_id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
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
        </div>
    </div>
</div>
@endsection