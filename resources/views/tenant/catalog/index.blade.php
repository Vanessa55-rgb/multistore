@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-12 py-5 text-center text-white rounded-5 shadow-lg position-relative overflow-hidden d-flex align-items-center justify-content-center"
            style="min-height: 400px; 
                            @if(tenant('banner'))
                                background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('storage/' . tenant('banner')) }}');
                                background-size: cover;
                                background-position: center;
                            @else
                                background: {{ tenant('color') ?? 'var(--primary-gradient)' }};
                            @endif">
            <div class="position-relative z-1 py-4">
                <h1 class="display-3 fw-bold mb-3">{{ tenant('name') }}</h1>
                <p class="lead mb-4 opacity-75">Tu destino favorito para {{ strtolower(tenant('business_type')) }} de
                    calidad.</p>
                <div class="d-flex justify-content-center gap-3">
                    <span class="badge bg-white text-dark p-2 px-3 rounded-pill shadow-sm">
                        <i class="bi bi-star-fill text-warning me-1"></i> 4.9 Calificación
                    </span>

                    <span class="badge bg-white text-dark p-2 px-3 rounded-pill shadow-sm">
                        <i class="bi bi-truck me-1"></i> Envío Rápido
                    </span>
                </div>
            </div>
            <div class="position-absolute bottom-0 start-0 w-100 h-100 opacity-25"
                style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        </div>
    </div>

    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold mb-0">Nuestros <span class="text-primary">Productos</span></h2>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm rounded-pill active">Todos</button>
                <button class="btn btn-outline-secondary btn-sm rounded-pill ms-2">Nuevos</button>
                <button class="btn btn-outline-secondary btn-sm rounded-pill ms-2">Ofertas</button>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($products as $product)
            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4 product-item" data-offer="{{ $product->is_offer ? '1' : '0' }}">
                <div class="card h-100 border-0 shadow-sm overflow-hidden product-card">
                    <div class="position-relative">
                        @if($product->image)
                            <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                                style="height: 250px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex flex-column justify-content-center align-items-center"
                                style="height: 250px;">
                                <i class="bi bi-image text-muted display-4 mb-2"></i>
                                <span class="text-muted small">Sin Imagen</span>
                            </div>
                        @endif

                        @if($product->is_offer)
                            <div class="position-absolute top-0 start-0 p-2">
                                <span class="badge bg-danger rounded-pill shadow-sm">15% OFF</span>
                            </div>
                        @endif

                        <div class="position-absolute top-0 end-0 p-2">
                            <button type="button" class="btn btn-white btn-sm rounded-circle shadow-sm like-btn"
                                data-id="{{ $product->id }}" title="Me gusta">
                                <i class="bi bi-heart text-danger"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="badge bg-light text-primary small">{{ tenant('business_type') }}</span>
                            <div class="text-muted small">
                                <i class="bi bi-eye me-1"></i>{{ $product->views }}
                                <i class="bi bi-heart-fill text-danger ms-2 me-1"></i><span
                                    class="likes-count-{{ $product->id }}">{{ $product->likes }}</span>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-1">{{ $product->name }}</h5>
                        <p class="card-text text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($product->is_offer)
                                    <h4 class="mb-0 fw-bold" style="color: {{ tenant('color') ?? '#6366f1' }}">
                                        ${{ number_format($product->offer_price, 0, ',', '.') }}
                                    </h4>
                                    <small
                                        class="text-muted text-decoration-line-through">${{ number_format($product->price, 0, ',', '.') }}</small>
                                @else
                                    <h4 class="mb-0 fw-bold" style="color: {{ tenant('color') ?? '#6366f1' }}">
                                        ${{ number_format($product->price, 0, ',', '.') }}
                                    </h4>
                                @endif
                            </div>
                            <a href="{{ route('tenant.products.show', $product) }}" class="btn btn-primary btn-sm rounded-3">
                                <i class="bi bi-eye me-1"></i>Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="bg-light p-5 rounded-5 shadow-sm">
                    <i class="bi bi-search display-1 text-muted mb-4"></i>
                    <h3>No encontramos productos</h3>
                    <p class="text-secondary">Estamos trabajando para traer lo mejor de {{ tenant('business_type') }} muy
                        pronto.</p>
                </div>
            </div>
        @endforelse
    </div>

    <script>
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const productId = this.dataset.id;
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
                            document.querySelectorAll('.likes-count-' + productId).forEach(el => {
                                el.textContent = data.likes;
                            });
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
        });

        // Filtro básico de pestañas
        const buttons = document.querySelectorAll('.btn-group .btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                buttons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.textContent.trim();
                document.querySelectorAll('.product-item').forEach(item => {
                    if (filter === 'Todos') {
                        item.style.display = 'block';
                    } else if (filter === 'Ofertas') {
                        item.style.display = item.dataset.offer === '1' ? 'block' : 'none';
                    } else {
                        item.style.display = 'block'; // Para "Nuevos" por ahora mostramos todos
                    }
                });
            });
        });
    </script>

    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .btn-white {
            background: white;
            border: none;
            color: #6366f1;
            transition: transform 0.2s ease;
        }

        .btn-white:hover {
            background: #f8fafc;
            color: #ef4444;
        }

        .like-btn i {
            transition: transform 0.2s ease;
        }
    </style>
@endsection