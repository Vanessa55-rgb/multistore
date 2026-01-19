@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Tenant</h1>
    <form action="{{ route('central.tenants.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tenant ID (Unique)</label>
            <input type="text" name="id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Domain</label>
            <input type="text" name="domain" class="form-control" required placeholder="shop.localhost">
        </div>
        <div class="mb-3">
            <label>Business Type</label>
            <select name="business_type" class="form-control">
                <option value="retail">Retail</option>
                <option value="food">Food</option>
                <option value="service">Service</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Brand Color</label>
            <input type="color" name="color" class="form-control form-control-color" value="#ffffff" title="Choose your color">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
