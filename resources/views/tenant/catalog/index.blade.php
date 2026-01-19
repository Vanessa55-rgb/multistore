@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header text-center mb-5">
        <h1>Welcome to {{ tenant('id') }}</h1>
        <p class="lead">Check out our exclusive products!</p>
    </div>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                    <div class="card-img-top bg-secondary text-white d-flex justify-content-center align-items-center" style="height: 200px;">
                        <span>No Image</span>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                    <h4 class="text-primary">${{ number_format($product->price, 2) }}</h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
