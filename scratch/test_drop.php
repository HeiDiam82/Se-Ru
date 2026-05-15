<?php
    $conn = new PDO("pgsql:host=ep-late-dawn-aoz3b2fa-pooler.c-2.ap-southeast-1.aws.neon.tech;dbname=neondb", "neondb_owner", "npg_q7ROijS6lUJQ");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->query("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'");
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);

    echo "Tables before drop: " . implode(", ", $tables) . "\n";

    foreach ($tables as $table) {
        $conn->exec("DROP TABLE IF EXISTS \"$table\" CASCADE");
    }

    $query = $conn->query("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'");
    $tables2 = $query->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables after drop: " . implode(", ", $tables2) . "\n";
