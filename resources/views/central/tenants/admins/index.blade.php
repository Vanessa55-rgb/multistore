@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admins for {{ $tenant->name }} ({{ $tenant->id }})</h1>
    <a href="{{ route('central.tenants.admins.create', $tenant->id) }}" class="btn btn-primary mb-3">Add Tenant Admin</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('central.tenants.admins.destroy', [$tenant->id, $user->id]) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user from the tenant?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('central.tenants.index') }}" class="btn btn-secondary mt-3">Back to Tenants</a>
</div>
@endsection
