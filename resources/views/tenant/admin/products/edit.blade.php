@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tenant.admin.products.index') }}">Productos</a></li>
            <li class="breadcrumb-item active">Editar Producto</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg p-5 rounded-5">
                <div class="card-body">
                    <div class="mb-5 text-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-pencil-square display-5"></i>
                        </div>
                        <h2 class="fw-bold">Editar <span class="text-primary">Producto</span></h2>
                        <p class="text-secondary">Actualiza la información de <strong>{{ $product->name }}</strong>.</p>
                    </div>

                    <form action="{{ route('tenant.admin.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nombre del Producto</label>
                            <input type="text" name="name" class="form-control rounded-pill px-4" value="{{ $product->name }}"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Descripción</label>
                            <textarea name="description" class="form-control rounded-4 px-4 py-3"
                                rows="3">{{ $product->description }}</textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-bold">Precio Regular ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-pill bg-light border-end-0">$</span>
                                    <input type="number" step="1" name="price" class="form-control rounded-end-pill px-4"
                                        value="{{ (int)$product->price }}" required>
                                </div>
                                <small class="text-muted ms-3">Ej: 45000 para $45.000</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nueva Imagen (opcional)</label>
                                <input type="file" name="image" class="form-control rounded-pill px-4" id="image_input" accept="image/*">
                                <div id="image_preview_container" class="mt-3">
                                    @if($product->image)
                                        <img id="image_preview" src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}" alt="Preview" class="img-thumbnail rounded-4" style="max-height: 150px;">
                                    @else
                                        <img id="image_preview" src="#" alt="Preview" class="img-thumbnail rounded-4" style="max-height: 150px; display: none;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('image_input').addEventListener('change', function(e) {
                                const preview = document.getElementById('image_preview');
                                if (e.target.files && e.target.files[0]) {
                                    const reader = new FileReader();
                                    reader.onload = function(ex) {
                                        preview.src = ex.target.result;
                                        preview.style.display = 'block';
                                    }
                                    reader.readAsDataURL(e.target.files[0]);
                                }
                            });
                        </script>

                        <div class="card bg-light border-0 rounded-4 mb-4">
                            <div class="card-body p-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_offer" name="is_offer" value="1"
                                        {{ $product->is_offer ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_offer">¿Está en Oferta?</label>
                                </div>
                                <div id="offer_price_container"
                                    style="display: {{ $product->is_offer ? 'block' : 'none' }};">
                                    <label class="form-label fw-bold">Precio de Oferta ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text rounded-start-pill bg-light border-end-0">$</span>
                                        <input type="number" step="1" name="offer_price" class="form-control rounded-end-pill px-4"
                                            value="{{ (int)$product->offer_price }}" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('is_offer').addEventListener('change', function () {
                                document.getElementById('offer_price_container').style.display = this.checked ? 'block' : 'none';
                            });
                        </script>

                        <div class="d-grid gap-3 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm" id="submit_btn">
                                <i class="bi bi-save me-2"></i><span id="btn_text">Guardar Cambios</span>
                            </button>
                            <a href="{{ route('tenant.admin.products.index') }}"
                                class="btn btn-light btn-lg rounded-pill border px-4">Cancelar</a>
                        </div>
                    </form>

                    <script>
                        document.querySelector('form').addEventListener('submit', function() {
                            const btn = document.getElementById('submit_btn');
                            const text = document.getElementById('btn_text');
                            btn.disabled = true;
                            text.textContent = 'Actualizando...';
                            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' + text.textContent;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection