# 🚀 MultiStore Hub - Panel de Control Centralizado

MultiStore Hub es una plataforma SaaS multitenant construida con **Laravel 11** y **Stancl/Tenancy 3**, diseñada para gestionar múltiples tiendas independientes desde un único punto.

## 📋 Requisitos del Sistema
- **PHP**: 8.3 o superior
- **Node.js**: 18.x o superior
- **Base de Datos**: MySQL / MariaDB
- **Extensiones PHP**: `intl`, `bcmath`, `gd`, `zip`

## 🛠️ Guía de Ejecución
Para iniciar el proyecto en tu entorno local, sigue estos pasos:

### 1. Preparación del Entorno
```bash
# Instalar dependencias de PHP
composer install

# Instalar dependencias de JS
npm install

# Copiar configuración de entorno
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=168.119.183.3
DB_PORT=3307
DB_DATABASE=multistore1
DB_USERNAME=root
DB_PASSWORD=

# Generar clave de aplicación
php artisan key:generate
```

### 2. Base de Datos y Seeders
```bash
# Ejecutar migraciones (Central y Tenants)
php artisan migrate --seed
```

### 3. Iniciar Servicios (Usar dos terminales)

**Terminal 1: Frontend (Recursos en vivo)**
```bash
npm run dev
```

**Terminal 2: Backend (Servidor Web)**
```bash
php artisan serve
```

---

## 🔗 Acceso y Credenciales

### 1. Panel de Control Central (Super Admin)
Gestiona todas las tiendas, dominios y administradores globales.
- **URL**: [http://localhost:8000/central/login](http://localhost:8000/central/login)
- **Usuario**: `admin@multistore.com`
- **Contraseña**: `password`

### 2. Tiendas (Tenants)
Cada tienda tiene su propio subdominio y base de datos independiente.
Recuerda usar **localhost:8000** en la URL.

- **Tienda Cocina**: [http://cocina.localhost:8000](http://cocina.localhost:8000)
- **Tienda Ferretería**: [http://ferreteria.localhost:8000](http://ferreteria.localhost:8000)
- **Tienda Gamer**: [http://gamer.localhost:8000](http://gamer.localhost:8000)
- **Tienda Joyería**: [http://joyeria.localhost:8000](http://joyeria.localhost:8000)
- **Tienda Papelería**: [http://papeleria.localhost:8000](http://papeleria.localhost:8000)

**Acceso Admin de Tienda:**
- **URL**: Accede a la tienda deseada y ve a "Iniciar Sesión" en la parte superior derecha.
- **Credenciales por Tienda**:
  - **Cocina**: `admin@cocina.com`
  - **Ferretería**: `admin@ferreteria.com`
  - **Gamer**: `admin@gamer.com`
  - **Joyería**: `admin@joyeria.com`
  - **Papelería**: `admin@papeleria.com`
- **Contraseña Única**: `password` (Para todas las tiendas).

## 🚀 Características Implementadas
- **Multi-Tenancy**: Aislamiento total de bases de datos y archivos por tienda.
- **Gestión de Stock**: Inventario con carga de imágenes y previsualización en tiempo real.
- **Ofertas Dinámicas**: Sistema de descuentos aplicado globalmente (15% OFF configurado).
- **Diseño Glassmorphism**: Interfaz moderna y responsive para una experiencia premium.
- **Subida de Archivos**: Optimizado para soportar imágenes locales y URLs externas.


