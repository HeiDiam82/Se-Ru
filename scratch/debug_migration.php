<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Clear the DB completely first
try {
    $conn = new PDO("pgsql:host=ep-late-dawn-aoz3b2fa-pooler.c-2.ap-southeast-1.aws.neon.tech;dbname=neondb", "neondb_owner", "npg_q7ROijS6lUJQ");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->query("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'");
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $conn->exec("DROP TABLE IF EXISTS \"$table\" CASCADE");
    }
} catch (Exception $e) {}

// Override connection to get raw PDO
$db = \Illuminate\Support\Facades\DB::connection();
$db->getPdo()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $kernel->call('migrate', ['--force' => true]);
    echo \Illuminate\Support\Facades\Artisan::output();
} catch (\Exception $e) {
    echo "First Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
