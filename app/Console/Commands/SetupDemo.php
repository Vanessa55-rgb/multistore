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
        $this->info('Cleaning up existing tenants...');
        Tenant::all()->each->delete();

        $tenants = [
            'kitchen' => ['business_type' => 'Kitchen', 'products' => ['Blender', 'Knife Set', 'Pan', 'Toaster', 'Microwave']],
            'hardware' => ['business_type' => 'Hardware', 'products' => ['Hammer', 'Drill', 'Screwdriver Set', 'Nails', 'Saw']],
            'jewelry' => ['business_type' => 'Jewelry', 'products' => ['Gold Ring', 'Silver Necklace', 'Diamond Earrings', 'Watch', 'Bracelet']],
            'gamer' => ['business_type' => 'Gamer', 'products' => ['Gaming Mouse', 'Mechanical Keyboard', 'Headset', 'Monitor 144Hz', 'RGB Strip']],
            'stationery' => ['business_type' => 'Stationery', 'products' => ['Notebook', 'Pen Set', 'Stapler', 'Binder', 'Markers']],
        ];

        foreach ($tenants as $id => $data) {
            $this->info("Creating tenant: $id ({$data['business_type']})");
            
            $tenant = Tenant::create([
                'id' => $id,
                'name' => ucfirst($id) . ' Store',
                'business_type' => $data['business_type'],
                'is_active' => true,
            ]);

            $tenant->domains()->create(['domain' => "$id.localhost"]);

            $this->info("Seeding data for $id...");
            
            $tenant->run(function () use ($data) {
                \App\Models\User::create([
                    'name' => 'Admin',
                    'email' => 'admin@' . tenant('id') . '.com',
                    'password' => bcrypt('password'),
                ]);

                foreach ($data['products'] as $productName) {
                    Product::create([
                        'name' => $productName,
                        'description' => "High quality $productName for your needs.",
                        'price' => rand(10, 500) + 0.99,
                        'image' => null,
                    ]);
                }
            });
        }

        $this->info('Demo setup complete!');
        $this->info('Access tenants at: http://kitchen.localhost, etc.');
        $this->info('Login with admin@<tenant>.com / password');
    }
}
