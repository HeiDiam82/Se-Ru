<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::where('role', 'user')->first();
        $ruko = \App\Models\Ruko::where('status', 'available')->first();

        if (!$user || !$ruko) {
            $this->command->warn('User atau Ruko tidak ditemukan. Jalankan DatabaseSeeder terlebih dahulu.');
            return;
        }

        // Booking pending — siap untuk divalidasi admin
        Booking::create([
            'user_id'         => $user->id,
            'ruko_id'         => $ruko->ruko_id,
            'duration_months' => 3,
            'usage_plan'      => 'Membuka toko kelontong dan kebutuhan sehari-hari untuk warga sekitar.',
            'ktp_proof'       => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Gatto_europeo4.jpg/320px-Gatto_europeo4.jpg',
            'transfer_proof'  => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/PNG_transparency_demonstration_1.png/320px-PNG_transparency_demonstration_1.png',
            'status'          => 'pending',
        ]);

        $this->command->info('Booking simulasi berhasil dibuat! Cek Admin > Pengajuan Sewa.');
    }
}
