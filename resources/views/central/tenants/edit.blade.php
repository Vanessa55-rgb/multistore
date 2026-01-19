@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Tenant: {{ $tenant->name }}</h1>
    <form action="{{ route('central.tenants.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tenant->name }}" required>
        </div>
        <div class="mb-3">
            <label>Business Type</label>
            <select name="business_type" class="form-control">
                <option value="retail" {{ $tenant->business_type == 'retail' ? 'selected' : '' }}>Retail</option>
                <option value="food" {{ $tenant->business_type == 'food' ? 'selected' : '' }}>Food</option>
                <option value="service" {{ $tenant->business_type == 'service' ? 'selected' : '' }}>Service</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Brand Color</label>
            <input type="color" name="color" class="form-control form-control-color" value="{{ $tenant->color ?? '#ffffff' }}" title="Choose your color">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="activeCheck" {{ $tenant->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="activeCheck">Active</label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('central.tenants.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
