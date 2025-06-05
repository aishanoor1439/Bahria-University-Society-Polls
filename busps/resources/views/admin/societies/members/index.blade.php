@extends('layouts.panel')

@section('title', 'Manage Members - ' . $society->society_name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Members of {{ $society->society_name }}</h4>
                        <a href="{{ route('societies.show', $society->society_id) }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-left"></i> Back to Society
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add Member Form -->
                    <div class="mb-4 p-3 bg-light rounded">
                        <h5><i class="fas fa-user-plus"></i> Add New Member</h5>
                        <form method="POST" action="{{ route('societies.members.store', $society->society_id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Student</label>
                                        <select name="student_id" class="form-control" required>
                                            <option value="">Select Student</option>
                                            @foreach($nonMembers as $student)
                                                <option value="{{ $student->student_id }}">
                                                    {{ $student->name }} ({{ $student->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <select name="position_id" class="form-control">
                                            <option value="">No Position</option>
                                            @foreach($positions as $position)
                                                <option value="{{ $position->position_id }}">
                                                    {{ $position->position_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Members Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td width="30%">
                                        <form method="POST" action="{{ route('societies.members.update', [$society->society_id, $student->student_id]) }}" class="form-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="position_id" class="form-control form-control-sm w-75" onchange="this.form.submit()">
                                                <option value="">No Position</option>
                                                @foreach($positions as $position)
                                                    <option value="{{ $position->position_id }}"
                                                        {{ $student->pivot->position_id == $position->position_id ? 'selected' : '' }}>
                                                        {{ $position->position_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('societies.members.destroy', [$society->society_id, $student->student_id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to remove this member?')">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No members found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection