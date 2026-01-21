<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;

class SetupDemo extends Command
{
    protected $signature = 'app:setup-demo';
    protected $description = 'Setup demo tenants and data';

    public function handle()
    {
        $this->info('Cleaning up existing tenant records...');
        \DB::table('domains')->delete();
        \DB::table('tenants')->delete();


        $tenants = [
            'cocina' => [
                'name' => 'Cocina Master',
                'business_type' => 'Cocina y Hogar',
                'color' => '#ef4444',
                'products' => [
                    ['name' => 'Licuadora Pro', 'price' => 89.99, 'desc' => 'Licuadora de alta potencia con 10 velocidades.'],
                    ['name' => 'Set de Cuchillos', 'price' => 45.00, 'desc' => 'Acero inoxidable de grado profesional.'],
                    ['name' => 'Sartén Antiadherente', 'price' => 29.99, 'desc' => 'Superficie de cerámica ultra resistente.'],
                ]
            ],
            'ferreteria' => [
                'name' => 'Ferretería Central',
                'business_type' => 'Herramientas y Construcción',
                'color' => '#f59e0b',
                'products' => [
                    ['name' => 'Taladro Inalámbrico', 'price' => 120.00, 'desc' => '20V con batería de larga duración.'],
                    ['name' => 'Juego de Destornilladores', 'price' => 15.50, 'desc' => 'Set de 20 piezas magnéticas.'],
                    ['name' => 'Martillo de Forja', 'price' => 22.00, 'desc' => 'Mango ergonómico anti-vibración.'],
                ]
            ],
            'joyeria' => [
                'name' => 'Luxury Jewels',
                'business_type' => 'Joyería y Relojería',
                'color' => '#ec4899',
                'products' => [
                    ['name' => 'Anillo de Diamante', 'price' => 1200.00, 'desc' => 'Oro blanco de 18k con diamante certificado.'],
                    ['name' => 'Reloj Elegance', 'price' => 350.00, 'desc' => 'Maquinaria suiza y cristal de zafiro.'],
                    ['name' => 'Collar de Perlas', 'price' => 180.00, 'desc' => 'Perlas naturales cultivadas.'],
                ]
            ],
            'gamer' => [
                'name' => 'Pro Gamer Hub',
                'business_type' => 'Tecnología Gamer',
                'color' => '#8b5cf6',
                'products' => [
                    ['name' => 'Teclado Mecánico RGB', 'price' => 95.00, 'desc' => 'Switches Blue con iluminación personalizable.'],
                    ['name' => 'Mouse Gaming 16000DPI', 'price' => 45.99, 'desc' => 'Sensor óptico de alta precisión.'],
                    ['name' => 'Headset 7.1 Surround', 'price' => 79.00, 'desc' => 'Audio inmersivo para competiciones.'],
                ]
            ],
            'papeleria' => [
                'name' => 'Papelería Creativa',
                'business_type' => 'Papelería y Oficina',
                'color' => '#10b981',
                'products' => [
                    ['name' => 'Planner Anual', 'price' => 25.00, 'desc' => 'Diseño Minimalista para organización total.'],
                    ['name' => 'Set de Marcadores', 'price' => 18.00, 'desc' => '24 colores punta pincel.'],
                    ['name' => 'Libreta Sketchbook', 'price' => 12.50, 'desc' => 'Papel de 160g ideal para dibujo.'],
                ]
            ],
        ];


        foreach ($tenants as $id => $data) {
            $this->info("⚙️ Configurando tienda: $id ({$data['business_type']})");

            $dbName = config('tenancy.database.prefix') . $id . config('tenancy.database.suffix');
            try {
                \DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $this->info("   ✅ Base de datos `$dbName` asegurada.");
            } catch (\Exception $e) {
                $this->warn("   ⚠️ No se pudo crear la DB `$dbName`: " . $e->getMessage());
            }

            if (!Tenant::where('id', $id)->exists()) {
                \DB::table('tenants')->insert([
                    'id' => $id,
                    'name' => $data['name'],
                    'business_type' => $data['business_type'],
                    'color' => $data['color'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Aseguramos que el dominio exista
            if (!\DB::table('domains')->where('tenant_id', $id)->exists()) {
                \DB::table('domains')->insert([
                    'domain' => "$id.localhost",
                    'tenant_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


            $tenant = Tenant::find($id);

            try {
                $tenant->run(function () use ($data, $id) {
                    $this->info("   ♻️ Limpiando tablas para " . tenant('id'));
                    \Schema::dropIfExists('products');
                    \Schema::dropIfExists('users');
                    \Schema::dropIfExists('migrations');

                    $this->info("   🏗️ Ejecutando migraciones...");
                    \Artisan::call('migrate', [
                        '--path' => 'database/migrations/tenant',
                        '--force' => true,
                    ]);

                    $this->info("   🖼️ Configurando imágenes demo...");
                    $demoImagePath = public_path("demo/{$id}.png");
                    $tenantImagePath = null;

                    if (file_exists($demoImagePath)) {
                        $imageContent = file_get_contents($demoImagePath);
                        $tenantImagePath = "products/{$id}_demo.png";
                        \Storage::disk('public')->put($tenantImagePath, $imageContent);
                    }

                    $this->info("   🌱 Sembrando datos...");
                    \App\Models\User::create([
                        'name' => 'Administrador ' . $data['name'],
                        'email' => 'admin@' . tenant('id') . '.com',
                        'password' => bcrypt('password'),
                    ]);

                    foreach ($data['products'] as $index => $p) {
                        \App\Models\Product::create([
                            'name' => $p['name'],
                            'description' => $p['desc'],
                            'price' => $p['price'],
                            'image' => ($index === 0) ? $tenantImagePath : null,
                        ]);
                    }
                });
            } catch (\Exception $e) {
                $this->error("   ❌ Error en $id: " . $e->getMessage());
            }

        }




        $this->info('Demo setup complete!');
        $this->info('Access tenants at: http://cocina.localhost:8000 , etc.');
        $this->info('Login with admin@<tenant>.com / password');

    }
}
