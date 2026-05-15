<?php
$url = "postgresql://neondb_owner:npg_q7ROijS6lUJQ@ep-late-dawn-aoz3b2fa-pooler.c-2.ap-southeast-1.aws.neon.tech/neondb?sslmode=require&channel_binding=require";
$opts = [
    "sslmode" => "require",
];

// Simple script to drop all tables in PostgreSQL
try {
    $conn = new PDO("pgsql:host=ep-late-dawn-aoz3b2fa-pooler.c-2.ap-southeast-1.aws.neon.tech;dbname=neondb", "neondb_owner", "npg_q7ROijS6lUJQ");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->query("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'");
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        $conn->exec("DROP TABLE IF EXISTS \"$table\" CASCADE");
        echo "Dropped table: $table\n";
    }

    $typesQuery = $conn->query("SELECT n.nspname as schema, t.typname as type FROM pg_type t LEFT JOIN pg_catalog.pg_namespace n ON n.oid = t.typnamespace WHERE (t.typrelid = 0 OR (SELECT c.relkind = 'c' FROM pg_catalog.pg_class c WHERE c.oid = t.typrelid)) AND NOT EXISTS(SELECT 1 FROM pg_catalog.pg_type el WHERE el.oid = t.typelem AND el.typarray = t.oid) AND n.nspname = 'public'");
    $types = $typesQuery->fetchAll(PDO::FETCH_ASSOC);

    foreach ($types as $type) {
        $conn->exec("DROP TYPE IF EXISTS \"" . $type['type'] . "\" CASCADE");
        echo "Dropped type: " . $type['type'] . "\n";
    }

    echo "Database cleared successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
