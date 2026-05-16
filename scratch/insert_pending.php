<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Booking;
use App\Models\Ruko;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Ensure Dewi Kusuma exists
$dewi = User::where('email', 'dewi@example.com')->first();
if (!$dewi) {
    $dewi = User::create([
        'name'     => 'Dewi Kusuma',
        'email'    => 'dewi@example.com',
        'password' => Hash::make('password123'),
        'role'     => 'user',
    ]);
    echo "Dewi Kusuma dibuat." . PHP_EOL;
} else {
    echo "Dewi Kusuma sudah ada (ID: {$dewi->id})." . PHP_EOL;
}

// Get an available ruko for pending booking
$ruko = Ruko::where('status', 'available')->first();
if (!$ruko) {
    echo "GAGAL: Tidak ada ruko available." . PHP_EOL;
    exit(1);
}

// Check if already has pending
$existing = Booking::where('ruko_id', $ruko->ruko_id)->where('status', 'pending')->first();
if ($existing) {
    echo "Sudah ada pending booking untuk: {$ruko->name} (ID: {$existing->booking_id})" . PHP_EOL;
} else {
    $booking = Booking::create([
        'user_id'         => $dewi->id,
        'ruko_id'         => $ruko->ruko_id,
        'duration_months' => 6,
        'usage_plan'      => 'Membuka toko pakaian dan aksesori fashion wanita untuk segmen menengah atas.',
        'ktp_proof'       => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=400&q=80',
        'transfer_proof'  => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&q=80',
        'status'          => 'pending',
    ]);
    echo "CREATED: Pending booking untuk '{$ruko->name}' oleh Dewi Kusuma (ID: {$booking->booking_id})" . PHP_EOL;
}

echo PHP_EOL . "=== SEMUA BOOKING ===" . PHP_EOL;
$all = Booking::with(['user', 'ruko'])->orderBy('status')->get();
foreach ($all as $b) {
    echo "  [{$b->status}] {$b->ruko->name} | by {$b->user->name}" . PHP_EOL;
}

echo PHP_EOL . "=== STATUS RUKO ===" . PHP_EOL;
$rukos = Ruko::all(['name', 'status']);
foreach ($rukos as $r) {
    echo "  {$r->name} => {$r->status}" . PHP_EOL;
}
