@extends('layouts.panel')

@section('title', 'Manage Societies')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Registered Societies</h4>
            <p class="category">Manage all societies</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($societies as $society)
                    <tr>
                        <td>{{ $society->society_id }}</td>
                        <td>{{ $society->society_name }}</td>
                        <td>{{ Str::limit($society->description, 50) }}</td>
                        <td>
                            <a href="{{ route('societies.show', $society->society_id) }}" class="btn btn-xs btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('societies.edit', $society->society_id) }}" class="btn btn-xs btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('societies.destroy', $society->society_id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('societies.create') }}" class="btn btn-primary gradient-custom-2 w-100 fw-bold fa-md">Add New Society</a>
        </div>
    </div>
</div>
@endsection