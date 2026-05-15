<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

\Illuminate\Support\Facades\DB::listen(function ($query) {
    echo $query->sql . "\n";
});

try {
    $kernel->call('migrate', ['--force' => true]);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
