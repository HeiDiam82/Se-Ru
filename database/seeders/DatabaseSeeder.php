<?php

namespace Database\Seeders;

use App\Models\Ruko;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin Account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@se-ru.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Seed Normal User Account
        User::create([
            'name' => 'Farrel Adhi (Penyewa)',
            'email' => 'farrel@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Seed Dummy Ruko
        Ruko::create([
            'name' => 'Ruko Sentra Bisnis Sudirman',
            'address' => 'Jl. Jend. Sudirman No. 45, Jakarta Pusat. Ruko 3 Lantai dengan area parkir luas.',
            'price' => 25000000,
            'status' => 'available',
            'photos' => [
                'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1497215842964-222b430dc094?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ]);

        Ruko::create([
            'name' => 'Ruko Minimalis Modern Kemang',
            'address' => 'Jl. Kemang Raya No. 12A, Jakarta Selatan. Cocok untuk cafe atau startup kantor.',
            'price' => 15000000,
            'status' => 'available',
            'photos' => [
                'https://images.unsplash.com/photo-1556910103-1c02745aae4d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ]);
        
        Ruko::create([
            'name' => 'Ruko Strategis Malioboro',
            'address' => 'Jl. Malioboro No. 88, Yogyakarta. Ruko di pusat keramaian turis.',
            'price' => 30000000,
            'status' => 'rented',
            'photos' => [
                'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ]);

        Ruko::create([
            'name' => 'Ruko Boulevard Kelapa Gading',
            'address' => 'Boulevard Raya Blok M No. 5, Jakarta Utara. Sangat cocok untuk restoran atau bank.',
            'price' => 45000000,
            'status' => 'rented',
            'photos' => [
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ]);
        
        Ruko::create([
            'name' => 'Kios Pasar Senen',
            'address' => 'Blok 3 Lantai Dasar, Jakarta Pusat. Traffic pengunjung sangat tinggi setiap hari.',
            'price' => 5000000,
            'status' => 'rented',
            'photos' => [
                'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ]);
    }
}
