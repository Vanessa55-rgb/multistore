@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tenant.admin.dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold mb-0">Inventario de <span class="text-primary">Productos</span></h1>
            <p class="text-secondary">Gestiona los productos disponibles en tu tienda.</p>
        </div>
        <a href="{{ route('tenant.admin.products.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Añadir Producto
        </a>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 text-start">Producto</th>
                        <th>Precio</th>
                        <th>Vistas</th>
                        <th>Likes</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="ps-4 text-start">
                                <div class="d-flex align-items-center">
                                    @if($product->image)
                                        <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}" class="rounded-3 me-3"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3"
                                            style="width: 50px; height: 50px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $product->name }}</h6>
                                        <small class="text-muted">{{ Str::limit($product->description, 30) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark">${{ number_format($product->price, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span
                                    class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">{{ $product->views }}</span>
                            </td>
                            <td>
                                <span
                                    class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">{{ $product->likes }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Disponible</span>
                            </td>
                            <td>
                                <div class="btn-actions-pill">
                                    <a href="{{ route('tenant.admin.products.edit', $product->id) }}" class="btn" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('tenant.admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" title="Eliminar" onclick="return confirm('¿Eliminar producto?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-5">
                                <i class="bi bi-box-seam display-1 text-muted opacity-25 mb-4"></i>
                                <h4 class="text-muted">No hay productos aún</h4>
                                <a href="{{ route('tenant.admin.products.create') }}" class="btn btn-primary btn-sm mt-3">Crear
                                    primer producto</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection