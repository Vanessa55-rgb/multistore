# Multi-CRUDilino Store Platform

A Multi-Tenant E-commerce Platform built with Laravel 10 and `stancl/tenancy`.

## Features

- **Central Domain (Admin Panel)**
    - Manage Tenants (Create, Disable, Edit)
    - Manage Central Administrators
- **Tenant Domain (Storefront)**
    - Isolated Inventory per Tenant
    - Public Catalog / Landing Page
    - Tenant Admin Panel for managing products
- **Demo Tenants**
    - Kitchen, Hardware, Jewelry, Gamer, Stationery

## Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/Vanessa55-rgb/multistore.git
    cd multistore
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Configure Environment**
    Copy `.env.example` to `.env`.
    
    **Database Name**: `multistore1`
    
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=multistore1
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

5.  **Setup Demo Data (Tenants & Products)**
    ```bash
    php artisan app:setup-demo
    ```

6.  **Serve Application**
    ```bash
    php artisan serve
    ```

## Accessing the Platform

### Central Admin
- **URL**: `http://localhost:8000/central/tenants`
- Manage all stores from here.

### Tenants
You can access the tenants at subdomains (requires hosts file configuration or proper DNS):
- **Kitchen Store**: `http://kitchen.localhost:8000`
- **Hardware Store**: `http://hardware.localhost:8000`
- **Jewelry Store**: `http://jewelry.localhost:8000`
- **Gamer Store**: `http://gamer.localhost:8000`
- **Stationery Store**: `http://stationery.localhost:8000`

### Tenant Admin Login
- **URL**: `http://<tenant>.localhost:8000/login`
- **Email**: `admin@<tenant>.com` (e.g., `admin@kitchen.com`)
- **Password**: `password`

## Architecture
- **Framework**: Laravel 10+
- **Tenancy**: `stancl/tenancy` (Single Database / Separate Schemas or Multi-Database depending on config)
- **Database**: mysql (`multistore1`)

## Docker Support
A `docker-compose.yml` is included for running with Laravel Sail.
```bash
./vendor/bin/sail up
```
