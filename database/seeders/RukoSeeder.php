<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Ruko;
use Illuminate\Database\Seeder;

class RukoSeeder extends Seeder
{
    public function run(): void
    {
        // ── Hapus ruko test yang tidak diperlukan ──────────────────────────
        $testNames = ['Ruko Test E2E', 'Ruko Test Browser'];
        foreach ($testNames as $name) {
            $ruko = Ruko::where('name', $name)->first();
            if ($ruko) {
                // Hapus booking terkait dulu (jika ada) baru hapus rukonya
                Booking::where('ruko_id', $ruko->ruko_id)->delete();
                $ruko->delete();
                $this->command->info("Deleted: $name");
            }
        }

        // ── Tambah 2 ruko baru ────────────────────────────────────────────
        Ruko::create([
            'name'    => 'Ruko Premium Cipete Selatan',
            'address' => 'Jl. Cipete Raya No. 30, Jakarta Selatan. Dua lantai dengan fasad kaca modern, akses mudah dari TB Simatupang, cocok untuk klinik, butik, atau kantor konsultan.',
            'price'   => 18500000,
            'status'  => 'available',
            'photos'  => [
                'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800&q=80',
                'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=800&q=80',
                'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=800&q=80',
            ],
        ]);

        Ruko::create([
            'name'    => 'Ruko Pusat Niaga Margonda Depok',
            'address' => 'Jl. Margonda Raya No. 115, Depok, Jawa Barat. Lantai 1 dari 3, luas 120m², dekat Universitas Indonesia dan Stasiun Depok Baru, ramai pejalan kaki.',
            'price'   => 9500000,
            'status'  => 'available',
            'photos'  => [
                'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&q=80',
                'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80',
            ],
        ]);

        $this->command->info('2 ruko baru berhasil ditambahkan.');
    }
}
