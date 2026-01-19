@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Inventory</h1>
    <a href="{{ route('tenant.admin.products.create') }}" class="btn btn-success mb-3">Add Product</a>

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="50">
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>
                    <button class="btn btn-sm btn-info">Edit</button>
                    <!-- Add delete form -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
