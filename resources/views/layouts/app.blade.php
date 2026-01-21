<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'MultiStore') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <style>
    :root {
      --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
      --glass-bg: rgba(255, 255, 255, 0.7);
      --glass-border: rgba(255, 255, 255, 0.2);
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Outfit', sans-serif;
      background-color: #f8fafc;
      color: #1e293b;
      min-height: 100vh;
      background: radial-gradient(circle at top right, #e2e8f0, #f8fafc);
    }

    .navbar {
      background: var(--glass-bg) !important;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--glass-border);
      padding: 1rem 0;
    }

    .navbar-brand {
      font-weight: 700;
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 1.5rem;
    }

    .btn-primary {
      background: var(--primary-gradient);
      border: none;
      border-radius: 12px;
      padding: 0.6rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
    }

    .card {
      background: var(--glass-bg);
      backdrop-filter: blur(8px);
      border: 1px solid var(--glass-border);
      border-radius: 20px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .tenant-custom-bar {
      height: 4px;
      width: 100%;
      background-color:
        {{ function_exists('tenant') && tenant() ? tenant('color') : '#6366f1' }}
      ;
    }
    .btn-actions-pill {
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 50px;
      display: inline-flex;
      align-items: center;
      padding: 0;
      overflow: hidden;
      transition: all 0.2s ease;
    }

    .btn-actions-pill a, 
    .btn-actions-pill button,
    .btn-actions-pill form {
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
    }

    .btn-actions-pill .btn {
      border: none;
      border-radius: 0;
      padding: 0.6rem 1.2rem;
      background: transparent;
      transition: all 0.2s ease;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-actions-pill > a:first-child,
    .btn-actions-pill > form:first-child .btn {
      border-right: 1px solid #e2e8f0;
      color: #3b82f6;
    }

    .btn-actions-pill > a:last-child,
    .btn-actions-pill > form:last-child .btn {
      color: #ef4444;
    }

    .btn-actions-pill .btn:hover {
      background: #f8fafc;
      transform: scale(1.1);
    }
  </style>
</head>

<body>
  <div class="tenant-custom-bar"></div>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <i class="bi bi-shop me-2"></i>
        {{ function_exists('tenant') && tenant() ? tenant('name') : 'Sistema MultiStore' }}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          @if(function_exists('tenant') && tenant())
            <li class="nav-item">
              <a class="nav-link" href="{{ route('tenant.catalog') }}">Catálogo Público</a>
            </li>
            @auth
              <li class="nav-item">
                <a class="nav-link" href="{{ route('tenant.admin.dashboard') }}">Productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('tenant.admin.settings') }}">Configuración</a>
              </li>
              <li class="nav-item ms-lg-3">
                <form action="{{ route('tenant.logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-outline-danger btn-sm rounded-pill px-3" type="submit">Cerrar Sesión</button>
                </form>
              </li>
            @else
              <li class="nav-item ms-lg-3">
                <a class="btn btn-primary" href="{{ route('tenant.login') }}">Iniciar Sesión</a>
              </li>
            @endauth

          @else
            @auth
              <li class="nav-item">
                <a class="nav-link" href="{{ route('central.tenants.index') }}">Gestionar Tiendas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('central.admins.index') }}">Admin Globales</a>
              </li>
              <li class="nav-item ms-lg-3">
                <form action="{{ route('central.logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-outline-danger btn-sm rounded-pill px-3" type="submit">Salir</button>
                </form>
              </li>
            @endauth
          @endif
        </ul>
      </div>

    </div>
  </nav>

  <main class="py-5">
    <div class="container">
      @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">
          {{ session('error') }}
        </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>