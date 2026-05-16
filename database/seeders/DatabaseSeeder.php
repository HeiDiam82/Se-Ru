<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Ruko;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── USERS ──────────────────────────────────────────────────────────
        $admin = User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@se-ru.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        $user1 = User::create([
            'name'     => 'Farrel Adhi Pratama',
            'email'    => 'farrel@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'user',
        ]);

        $user2 = User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'user',
        ]);

        // ─── RUKO ───────────────────────────────────────────────────────────
        // Foto menggunakan URL Unsplash (CDN) — ringan, tidak perlu simpan file lokal

        $ruko1 = Ruko::create([
            'name'    => 'Ruko Sentra Bisnis Sudirman',
            'address' => 'Jl. Jend. Sudirman No. 45, Jakarta Pusat. Ruko 3 lantai dengan area parkir luas, cocok untuk kantor, bank, atau showroom.',
            'price'   => 25000000,
            'status'  => 'available',
            'photos'  => [
                'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80',
                'https://images.unsplash.com/photo-1497215842964-222b430dc094?w=800&q=80',
                'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&q=80',
            ],
        ]);

        $ruko2 = Ruko::create([
            'name'    => 'Ruko Minimalis Modern Kemang',
            'address' => 'Jl. Kemang Raya No. 12A, Jakarta Selatan. Desain modern dua lantai, cocok untuk cafe, studio kreatif, atau startup kantor.',
            'price'   => 15000000,
            'status'  => 'available',
            'photos'  => [
                'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&q=80',
                'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800&q=80',
            ],
        ]);

        $ruko3 = Ruko::create([
            'name'    => 'Ruko Strategis Malioboro',
            'address' => 'Jl. Malioboro No. 88, Yogyakarta. Lokasi sangat strategis di pusat keramaian wisatawan, cocok untuk oleh-oleh atau retail fashion.',
            'price'   => 30000000,
            'status'  => 'available',
            'photos'  => [
                'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80',
                'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80',
                'https://images.unsplash.com/photo-1559329007-40df8a9345d8?w=800&q=80',
            ],
        ]);

        $ruko4 = Ruko::create([
            'name'    => 'Ruko Boulevard Kelapa Gading',
            'address' => 'Boulevard Raya Blok M No. 5, Jakarta Utara. Luas 250m², 3 lantai, akses mudah dari tol dan area perumahan premium.',
            'price'   => 45000000,
            'status'  => 'rented',
            'photos'  => [
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80',
                'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=800&q=80',
            ],
        ]);

        $ruko5 = Ruko::create([
            'name'    => 'Kios Foodcourt Pasar Senen',
            'address' => 'Blok 3 Lantai Dasar, Pasar Senen, Jakarta Pusat. Traffic pengunjung sangat tinggi, sudah tersedia instalasi listrik & air.',
            'price'   => 5000000,
            'status'  => 'rented',
            'photos'  => [
                'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&q=80',
                'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80',
            ],
        ]);

        $ruko6 = Ruko::create([
            'name'    => 'Ruko Koridor Bisnis Gatot Subroto',
            'address' => 'Jl. Gatot Subroto No. 99, Jakarta Selatan. Dekat perkantoran SCBD & Rasuna Said, parkir basement tersedia.',
            'price'   => 35000000,
            'status'  => 'available',
            'photos'  => [
                'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80',
                'https://images.unsplash.com/photo-1460317442991-0ec209397118?w=800&q=80',
            ],
        ]);

        $ruko7 = Ruko::create([
            'name'    => 'Toko Ritel Grand Batam Center',
            'address' => 'Komplek Ruko Grand Batam Center No. 21, Batam, Kepulauan Riau. Area bebas bea cukai, cocok untuk usaha elektronik dan fashion.',
            'price'   => 12000000,
            'status'  => 'available',
            'photos'  => [
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=80',
                'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=800&q=80',
            ],
        ]);

        // ─── BOOKINGS ───────────────────────────────────────────────────────
        // Logika: hanya ruko yang statusnya 'rented' yang memiliki booking approved.
        // Ruko 'available' tidak memiliki booking aktif.
        // Tidak ada 'pending' booking tanpa KTP dan bukti transfer.

        // Booking APPROVED — ruko4 (Kelapa Gading) sudah disewa oleh user1
        Booking::create([
            'user_id'         => $user1->id,
            'ruko_id'         => $ruko4->ruko_id,
            'duration_months' => 12,
            'usage_plan'      => 'Membuka showroom furnitur premium dan interior design untuk segmen menengah atas.',
            'ktp_proof'       => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=400&q=80',
            'transfer_proof'  => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&q=80',
            'status'          => 'approved',
        ]);

        // Booking APPROVED — ruko5 (Pasar Senen) sudah disewa oleh user2
        Booking::create([
            'user_id'         => $user2->id,
            'ruko_id'         => $ruko5->ruko_id,
            'duration_months' => 6,
            'usage_plan'      => 'Membuka warung makan khas Padang untuk karyawan dan pengunjung pasar.',
            'ktp_proof'       => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=400&q=80',
            'transfer_proof'  => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&q=80',
            'status'          => 'approved',
        ]);

        // Booking PENDING — user2 mengajukan sewa ruko6 (belum diproses admin)
        // Ada KTP dan bukti transfer karena memang sudah diisi saat pengajuan
        Booking::create([
            'user_id'         => $user2->id,
            'ruko_id'         => $ruko6->ruko_id,
            'duration_months' => 3,
            'usage_plan'      => 'Membuka kantor konsultan pajak dan akuntansi untuk klien korporat di kawasan SCBD.',
            'ktp_proof'       => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=400&q=80',
            'transfer_proof'  => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&q=80',
            'status'          => 'pending',
        ]);

        // Booking REJECTED — user1 pernah mencoba sewa ruko3 tapi ditolak
        Booking::create([
            'user_id'         => $user1->id,
            'ruko_id'         => $ruko3->ruko_id,
            'duration_months' => 1,
            'usage_plan'      => 'Membuka pop-up store batik modern selama festival Malioboro.',
            'ktp_proof'       => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=400&q=80',
            'transfer_proof'  => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&q=80',
            'status'          => 'rejected',
        ]);
    }
}
