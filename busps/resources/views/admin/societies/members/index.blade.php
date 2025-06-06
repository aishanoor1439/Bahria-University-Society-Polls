@extends('layouts.panel')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Members of {{ $society->society_name }}</h4>
        <a href="{{ route('societies.show', $society->society_id) }}" class="btn btn-sm btn-default">
            <i class="fas fa-arrow-left"></i> Back to Society
        </a>
    </div>
    <div class="card-body">
        <!-- Add Member Form -->
        <form method="POST" action="{{ route('societies.members.store', $society->society_id) }}" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <select name="student_id" class="form-control" required>
                        <option value="">Select Student</option>
                        @foreach($nonMembers as $student)
                        <option value="{{ $student->student_id }}">
                            {{ $student->name }} ({{ $student->email }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="position_id" class="form-control">
                        <option value="">No Position</option>
                        @foreach($positions as $position)
                        <option value="{{ $position->position_id }}">
                            {{ $position->position_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Add Member</button>
                </div>
            </div>
        </form>

        <!-- Members Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        <form method="POST" action="{{ route('societies.members.update', [$society->society_id, $member->student_id]) }}">
                            @csrf @method('PUT')
                            <select name="position_id" onchange="this.form.submit()">
                                <option value="">No Position</option>
                                @foreach($positions as $position)
                                <option value="{{ $position->position_id }}"
                                    {{ $member->pivot_position_id == $position->position_id ? 'selected' : '' }}>
                                    {{ $position->position_name }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('societies.members.destroy', [$society->society_id, $member->student_id]) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection