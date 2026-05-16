<?php

/**
 * Script: seed_bookings.php
 * Tujuan: Masukkan riwayat booking untuk semua ruko yang statusnya 'rented'.
 * Logika: Jika ruko berstatus 'rented', maka pernah ada booking dengan status 'approved'.
 *
 * Cara jalankan: php artisan eval --file=scratch/seed_bookings.php
 * atau lewat route debug / artisan command
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Booking;
use App\Models\Ruko;
use App\Models\User;
use Illuminate\Support\Str;

echo "=== Seed Booking History ===" . PHP_EOL;

// Ambil semua ruko yang berstatus rented
$rentedRukos = Ruko::where('status', 'rented')->get();
echo "Ruko berstatus 'rented': " . $rentedRukos->count() . PHP_EOL;

if ($rentedRukos->isEmpty()) {
    echo "Tidak ada ruko yang disewa. Selesai." . PHP_EOL;
    exit(0);
}

// Cek existing bookings
$existingBookings = Booking::whereIn('ruko_id', $rentedRukos->pluck('ruko_id'))
    ->where('status', 'approved')
    ->get();
echo "Booking approved yang sudah ada untuk ruko tersebut: " . $existingBookings->count() . PHP_EOL;

$rukoIdsThatHaveBooking = $existingBookings->pluck('ruko_id')->toArray();

// Ambil users
$users = User::where('role', 'user')->get();
if ($users->isEmpty()) {
    echo "GAGAL: Tidak ada user dengan role 'user'. Pastikan DatabaseSeeder sudah dijalankan." . PHP_EOL;
    exit(1);
}

$userIndex = 0;
$created = 0;
$skipped = 0;

foreach ($rentedRukos as $ruko) {
    if (in_array($ruko->ruko_id, $rukoIdsThatHaveBooking)) {
        echo "SKIP: Ruko '{$ruko->name}' sudah punya booking approved." . PHP_EOL;
        $skipped++;
        continue;
    }

    // Pilih user secara bergantian
    $user = $users[$userIndex % $users->count()];
    $userIndex++;

    // Generate data booking yang masuk akal berdasarkan nama ruko
    $usagePlans = [
        'default'   => 'Menggunakan ruko untuk kegiatan usaha dan perdagangan.',
        'makanan'   => 'Membuka restoran atau kedai makanan untuk memenuhi kebutuhan masyarakat sekitar.',
        'retail'    => 'Membuka toko retail pakaian dan aksesori fashion.',
        'kantor'    => 'Menjadikan ruko sebagai kantor operasional perusahaan.',
        'showroom'  => 'Membuka showroom produk furnitur dan dekorasi interior.',
    ];

    $nameLower = strtolower($ruko->name);
    if (str_contains($nameLower, 'food') || str_contains($nameLower, 'makan') || str_contains($nameLower, 'kios')) {
        $plan = $usagePlans['makanan'];
    } elseif (str_contains($nameLower, 'kantor') || str_contains($nameLower, 'bisnis')) {
        $plan = $usagePlans['kantor'];
    } elseif (str_contains($nameLower, 'retail') || str_contains($nameLower, 'toko')) {
        $plan = $usagePlans['retail'];
    } elseif (str_contains($nameLower, 'show')) {
        $plan = $usagePlans['showroom'];
    } else {
        $plan = $usagePlans['default'];
    }

    $booking = Booking::create([
        'user_id'         => $user->id,
        'ruko_id'         => $ruko->ruko_id,
        'duration_months' => rand(6, 12),
        'usage_plan'      => $plan,
        'ktp_proof'       => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=400&q=80',
        'transfer_proof'  => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&q=80',
        'status'          => 'approved',
    ]);

    echo "CREATED: Booking untuk '{$ruko->name}' oleh user '{$user->name}' (ID: {$booking->booking_id})" . PHP_EOL;
    $created++;
}

echo PHP_EOL;
echo "=== Selesai ===" . PHP_EOL;
echo "Dibuat  : {$created}" . PHP_EOL;
echo "Dilewati: {$skipped}" . PHP_EOL;

// Tampilkan semua booking sekarang
echo PHP_EOL . "=== Semua Booking di Database ===" . PHP_EOL;
$allBookings = Booking::with(['user', 'ruko'])->get();
foreach ($allBookings as $b) {
    echo "- [{$b->status}] {$b->ruko->name} | by {$b->user->name}" . PHP_EOL;
}
