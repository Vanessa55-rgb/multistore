@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg overflow-hidden rounded-5">
                    @if($product->image)
                        <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}"
                            style="min-height: 500px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex flex-column justify-content-center align-items-center"
                            style="height: 500px;">
                            <i class="bi bi-image text-muted display-1 mb-3"></i>
                            <span class="text-muted fs-4">Sin Imagen</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tenant.catalog') }}"
                                    class="text-decoration-none">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>

                    @if($product->is_offer)
                        <span class="badge bg-danger rounded-pill px-3 py-2 mb-2 shadow-sm">15% OFF</span>
                    @endif
                    <h1 class="display-4 fw-bold mb-3">{{ $product->name }}</h1>

                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            @if($product->is_offer)
                                <h2 class="fw-bold mb-0" style="color: {{ tenant('color') ?? '#6366f1' }}">
                                    ${{ number_format($product->offer_price, 0, ',', '.') }}
                                </h2>
                                <span
                                    class="text-muted text-decoration-line-through">${{ number_format($product->price, 0, ',', '.') }}</span>
                            @else
                                <h2 class="fw-bold mb-0" style="color: {{ tenant('color') ?? '#6366f1' }}">
                                    ${{ number_format($product->price, 0, ',', '.') }}
                                </h2>
                            @endif
                        </div>
                        <span class="badge bg-light text-primary p-2 px-3 rounded-pill border">
                            <i class="bi bi-eye-fill me-1"></i> {{ $product->views }} Vistas
                        </span>
                        <span class="badge bg-light text-danger p-2 px-3 rounded-pill border ms-2">
                            <i class="bi bi-heart-fill me-1"></i> <span id="likes-count">{{ $product->likes }}</span> Me
                            gusta
                        </span>
                    </div>

                    <hr class="my-4 opacity-25">

                    <h5 class="fw-bold mb-3">Descripción</h5>
                    <p class="lead text-secondary mb-5">
                        {{ $product->description }}
                    </p>

                    <div class="d-grid gap-3 d-md-flex align-items-center mt-5">
                        <button type="button" id="like-btn"
                            class="btn btn-outline-danger btn-lg rounded-pill px-4 py-3 w-100">
                            <i class="bi bi-heart me-2"></i> Me gusta
                        </button>
                    </div>

                    <script>
                        const productId = {{ $product->id }};
                        document.getElementById('like-btn').addEventListener('click', function () {
                            const icon = this.querySelector('i');
                            const isLiked = icon.classList.contains('bi-heart-fill');

                            icon.style.transform = 'scale(1.4)';
                            if (isLiked) {
                                icon.classList.remove('bi-heart-fill');
                                icon.classList.add('bi-heart');
                            } else {
                                icon.classList.remove('bi-heart');
                                icon.classList.add('bi-heart-fill');
                            }

                            setTimeout(() => icon.style.transform = 'scale(1)', 200);

                            fetch(`/product/${productId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('likes-count').textContent = data.likes;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        if (isLiked) {
                            icon.classList.add('bi-heart-fill');
                            icon.classList.remove('bi-heart');
                        } else {
                            icon.classList.add('bi-heart');
                            icon.classList.remove('bi-heart-fill');
                        }
                    });
                        });
                    </script>

                    <div class="mt-5 p-4 bg-white border border-light shadow-sm rounded-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle p-3"
                                    style="background: {{ (tenant('color') ?? '#6366f1') . '20' }}">
                                    <i class="bi bi-shield-check fs-3 text-primary"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-0">Compra Segura</h6>
                                <p class="text-muted small mb-0">Garantía oficial de {{ tenant('name') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection