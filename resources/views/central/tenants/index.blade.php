@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tenants</h1>
    <a href="{{ route('central.tenants.create') }}" class="btn btn-primary mb-3">Create Tenant</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Domain</th>
                <th>Business</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenants as $tenant)
            <tr>
                <td>{{ $tenant->id }}</td>
                <td>{{ $tenant->name }}</td>
                <td>
                    @foreach($tenant->domains as $domain)
                        {{ $domain->domain }}<br>
                    @endforeach
                </td>
                <td>{{ $tenant->business_type }}</td>
                <td>{{ $tenant->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('central.tenants.admins.index', $tenant->id) }}" class="btn btn-sm btn-info">Admins</a>
                    <a href="{{ route('central.tenants.edit', $tenant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('central.tenants.destroy', $tenant->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
