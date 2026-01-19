@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Central Administrators</h1>
    <a href="{{ route('central.admins.create') }}" class="btn btn-primary mb-3">Create Admin</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('central.admins.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    @if(auth()->id() !== $admin->id)
                    <form action="{{ route('central.admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete admin?')">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
