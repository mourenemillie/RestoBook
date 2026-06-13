<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin.sistem@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        // 2. Dummy Customers
        User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'customer'
        ]);

        // 3. Restaurants Data
        $restaurants = [
            [
                'owner' => 'Owner Begadang',
                'email' => 'begadang@restobook.com',
                'name' => 'Sate Padang Begadang',
                'address' => 'Jl. Diponegoro',
                'city' => 'Bandar Lampung',
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400&h=300&fit=crop',
                'menus' => [
                    ['name' => 'Sate Padang', 'price' => 25000, 'category' => 'Makanan'],
                    ['name' => 'Kerupuk Kulit', 'price' => 5000, 'category' => 'Cemilan'],
                    ['name' => 'Es Teh Manis', 'price' => 5000, 'category' => 'Minuman']
                ]
            ],
            [
                'owner' => 'Owner Sony',
                'email' => 'sony@restobook.com',
                'name' => 'Bakso Son Haji Sony',
                'address' => 'Jl. Wolter Monginsidi',
                'city' => 'Bandar Lampung',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop',
                'menus' => [
                    ['name' => 'Bakso Urat', 'price' => 20000, 'category' => 'Makanan'],
                    ['name' => 'Mie Ayam Bakso', 'price' => 22000, 'category' => 'Makanan'],
                    ['name' => 'Es Jeruk', 'price' => 6000, 'category' => 'Minuman']
                ]
            ],
            [
                'owner' => 'Owner Hub',
                'email' => 'hub@restobook.com',
                'name' => 'Kopi Lampung Hub',
                'address' => 'Way Halim',
                'city' => 'Bandar Lampung',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=300&fit=crop',
                'menus' => [
                    ['name' => 'Kopi Robusta', 'price' => 15000, 'category' => 'Minuman'],
                    ['name' => 'Kopi Susu Gula Aren', 'price' => 18000, 'category' => 'Minuman'],
                    ['name' => 'Roti Bakar', 'price' => 12000, 'category' => 'Cemilan']
                ]
            ],
            [
                'owner' => 'Owner Bangka',
                'email' => 'bangka@restobook.com',
                'name' => 'Martabak Bangka Sari',
                'address' => 'Kemiling',
                'city' => 'Bandar Lampung',
                'image' => 'https://images.unsplash.com/photo-1541592106381-b31e9677c0e5?w=400&h=300&fit=crop',
                'menus' => [
                    ['name' => 'Martabak Manis Keju', 'price' => 35000, 'category' => 'Makanan'],
                    ['name' => 'Martabak Telur Spesial', 'price' => 40000, 'category' => 'Makanan']
                ]
            ],
            [
                'owner' => 'Owner Pak Jo',
                'email' => 'pakjo@restobook.com',
                'name' => 'Mie Ayam Pak Jo',
                'address' => 'Sukabumi',
                'city' => 'Bandar Lampung',
                'image' => 'https://images.unsplash.com/photo-1552611052-33e04de081de?w=400&h=300&fit=crop',
                'menus' => [
                    ['name' => 'Mie Ayam Pangsit', 'price' => 15000, 'category' => 'Makanan'],
                    ['name' => 'Mie Ayam Ceker', 'price' => 18000, 'category' => 'Makanan']
                ]
            ]
        ];

        foreach ($restaurants as $r) {
            $owner = User::create([
                'name' => $r['owner'],
                'email' => $r['email'],
                'password' => bcrypt('password'),
                'role' => 'owner'
            ]);

            $restaurant = Restaurant::create([
                'user_id' => $owner->id,
                'name' => $r['name'],
                'address' => $r['address'],
                'city' => $r['city'],
                'phone' => '081234567890',
                'image' => $r['image'],
                'open_time' => '09:00:00', // Jam buka default
                'close_time' => '22:00:00', // Jam tutup default
                'status' => 'active' // Langsung disetujui (active) agar tampil di pelanggan
            ]);

            foreach ($r['menus'] as $m) {
                Menu::create([
                    'restaurant_id' => $restaurant->id,
                    'name' => $m['name'],
                    'price' => $m['price'],
                    'category' => $m['category'],
                    'is_available' => true
                ]);
            }

            for ($i = 1; $i <= 5; $i++) {
                Table::create([
                    'restaurant_id' => $restaurant->id,
                    'table_number' => 'M' . $i,
                    'capacity' => 4,
                    'status' => 'available'
                ]);
            }
        }