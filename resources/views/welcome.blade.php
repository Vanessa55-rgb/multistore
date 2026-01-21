@extends('layouts.app')

@section('content')
    <div class="row align-items-center py-5 my-5" style="min-height: 80vh;">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="display-3 fw-bold mb-4">
                Impulsa Tu Negocio con <span class="text-primary">MultiStore</span>
            </h1>
            <p class="lead text-secondary mb-5">
                La plataforma multi-inquilino definitiva para gestionar múltiples tiendas desde un solo lugar. Simple,
                potente y escalable.
            </p>
            <div class="d-flex gap-3">
                @auth
                    <a href="{{ route('central.tenants.index') }}" class="btn btn-primary btn-lg px-5 shadow-sm">
                        <i class="bi bi-speedometer2 me-2"></i>Ir al Panel
                    </a>

                    <form action="{{ route('central.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-lg px-4">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Panel Central
                    </a>
                @endauth

                <a href="#features" class="btn btn-outline-secondary btn-lg px-5">
                    Saber Más
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-4 overflow-hidden border-0 shadow-lg"
                style="background: var(--primary-gradient); min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <div class="card-body text-white text-center py-5">
                    <i class="bi bi-rocket-takeoff-fill style-icon mb-4" style="font-size: 6rem;"></i>
                    <h2 class="fw-bold">Arquitectura Multi-Tenant</h2>
                    <p class="opacity-75">Aislamiento total de datos para cada cliente con bases de datos independientes.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-5 mt-5">
        <div class="col-12 text-center mb-5">
            <h2 class="display-5 fw-bold">Nuestras Tiendas <span class="text-primary">Demo</span></h2>
            <p class="text-secondary">Explora los diferentes inquilinos configurados en el sistema.</p>
        </div>
        <div class="col-12">
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @php
                    $demos = [
                        'cocina' => ['name' => '🍽️ Cocina', 'color' => '#ef4444'],
                        'ferreteria' => ['name' => '🛠️ Ferretería', 'color' => '#f59e0b'],
                        'joyeria' => ['name' => '💎 Joyería', 'color' => '#ec4899'],
                        'gamer' => ['name' => '🎮 Gamer', 'color' => '#8b5cf6'],
                        'papeleria' => ['name' => '📚 Papelería', 'color' => '#10b981'],
                    ];
                @endphp
                @foreach($demos as $id => $data)
                    <a href="http://{{ $id }}.localhost:8000" target="_blank"
                        class="btn btn-white shadow-sm p-4 rounded-4 border-0 hover-lift text-decoration-none text-center"
                        style="min-width: 180px; transition: transform 0.3s ease;">
                        <div class="rounded-circle mb-3 mx-auto"
                            style="width: 50px; height: 50px; background: {{ $data['color'] }}; opacity: 0.1;"></div>
                        <h5 class="fw-bold mb-0 text-dark">{{ $data['name'] }}</h5>
                        <small class="text-primary fw-bold">http://{{ $id }}.localhost:8000/</small>
                    </a>

                @endforeach
            </div>
        </div>
    </div>
    <style>
        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .btn-white {
            background: white;
        }
    </style>


    <div class="row py-5 my-5 text-center bg-light rounded-5">
        <div class="col-12 mb-5">
            <h2 class="display-5 fw-bold">Arquitectura <span class="text-primary">Técnica</span></h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 border-0 shadow-sm rounded-4">

                <div class="card-body">
                    <i class="bi bi-shield-check text-primary display-4 mb-3"></i>
                    <h3 class="h4 fw-bold">Seguridad Total</h3>
                    <p class="text-secondary">Bases de datos independientes para cada tienda, garantizando la privacidad y
                        seguridad de los datos.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <i class="bi bi-palette text-primary display-4 mb-3"></i>
                    <h3 class="h4 fw-bold">Personalización</h3>
                    <p class="text-secondary">Cada tienda puede tener su propia identidad visual, colores y dominio
                        personalizado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <i class="bi bi-graph-up-arrow text-primary display-4 mb-3"></i>
                    <h3 class="h4 fw-bold">Escalabilidad</h3>
                    <p class="text-secondary">Añade nuevos negocios en segundos sin afectar el rendimiento de las tiendas
                        existentes.</p>
                </div>
            </div>
        </div>
    </div>
@endsection