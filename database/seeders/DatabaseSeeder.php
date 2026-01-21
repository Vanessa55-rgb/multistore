<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Central Admin
        User::updateOrCreate(
            ['email' => 'admin@multistore.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $tenants = [
            'cocina' => [
                'name' => 'Tienda de Cocina',
                'type' => 'Hogar',
                'color' => '#ef4444',
                'products' => [
                    [
                        'name' => 'Licuadora Pro 500',
                        'description' => 'Alta potencia para tu cocina con múltiples velocidades.',
                        'price' => 250000,
                        'is_offer' => true,
                        'offer_price' => 212500, // 15% desc
                        'image' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=800'
                    ],
                    [
                        'name' => 'Set de Sartenes',
                        'description' => 'Antiadherente profesional de alta durabilidad.',
                        'price' => 150000,
                        'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?q=80&w=800'
                    ]
                ]
            ],
            'ferreteria' => [
                'name' => 'Ferretería General',
                'type' => 'Ferretería',
                'color' => '#f59e0b',
                'products' => [
                    [
                        'name' => 'Taladro Percutor 20V',
                        'description' => 'Potencia inalámbrica para tus proyectos de hogar.',
                        'price' => 450000,
                        'is_offer' => true,
                        'offer_price' => 382500, // 15% desc
                        'image' => 'https://images.unsplash.com/photo-1581147036324-c17ac41dfa6c?q=80&w=800'
                    ],
                    [
                        'name' => 'Pulidora de Banco',
                        'description' => 'Trabajo pesado y acabados perfectos.',
                        'price' => 180000,
                        'image' => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?q=80&w=800'
                    ]
                ]
            ],
            'gamer' => [
                'name' => 'Zona Gamer',
                'type' => 'Tecnología',
                'color' => '#6366f1',
                'products' => [
                    [
                        'name' => 'Diadema RGB 7.1',
                        'description' => 'Sonido envolvente para máxima inmersión.',
                        'price' => 180000,
                        'is_offer' => true,
                        'offer_price' => 153000, // 15% desc
                        'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?q=80&w=800'
                    ],
                    [
                        'name' => 'Mouse Gaming Pro',
                        'description' => '16000 DPI con luces RGB personalizables.',
                        'price' => 95000,
                        'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?q=80&w=800'
                    ]
                ]
            ],
            'joyeria' => [
                'name' => 'Joyas & Brillo',
                'type' => 'Accesorios',
                'color' => '#ec4899',
                'products' => [
                    [
                        'name' => 'Collar de Plata 925',
                        'description' => 'Elegancia y brillo para momentos especiales.',
                        'price' => 85000,
                        'is_offer' => true,
                        'offer_price' => 72250, // 15% desc
                        'image' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=800'
                    ],
                    [
                        'name' => 'Anillo Esmeralda',
                        'description' => 'Piedra natural auténtica en engaste de oro.',
                        'price' => 550000,
                        'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=800'
                    ]
                ]
            ],
            'papeleria' => [
                'name' => 'Gran Papelería',
                'type' => 'Papelería',
                'color' => '#10b981',
                'products' => [
                    [
                        'name' => 'Set de Plumones 48 Colores',
                        'description' => 'Doble punta para dibujo artístico.',
                        'price' => 42000,
                        'is_offer' => true,
                        'offer_price' => 35700, // 15% desc
                        'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?q=80&w=800'
                    ],
                    [
                        'name' => 'Agenda Ejecutiva 2024',
                        'description' => 'Tapa dura con cierre elástico para organizarte.',
                        'price' => 35000,
                        'image' => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?q=80&w=800'
                    ]
                ]
            ]
        ];

        foreach ($tenants as $id => $data) {
            $tenant = Tenant::updateOrCreate(['id' => $id], [
                'name' => $data['name'],
                'business_type' => $data['type'],
                'color' => $data['color'],
            ]);
            
            $tenant->domains()->updateOrCreate(['domain' => $id . '.localhost']);

            $tenant->run(function () use ($data, $tenant, $id) {
                User::truncate(); // Clean old admins
                User::updateOrCreate(
                    ['email' => 'admin@' . $id . '.com'],
                    ['name' => $tenant->name . ' Admin', 'password' => Hash::make('password')]
                );

                Product::truncate();
                foreach ($data['products'] as $p) {
                    Product::create($p);
                }
            });
        }
    }
}
