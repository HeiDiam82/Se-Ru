<?php
try {
    $conn = new PDO("pgsql:host=ep-late-dawn-aoz3b2fa-pooler.c-2.ap-southeast-1.aws.neon.tech;dbname=neondb", "neondb_owner", "npg_q7ROijS6lUJQ");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'create table "users" ("id" uuid not null, "name" varchar(255) not null, "email" varchar(255) not null, "email_verified_at" timestamp(0) without time zone null, "password" varchar(255) not null, "role" varchar(255) not null default \'user\', "remember_token" varchar(100) null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)';
    echo "Running Create Users Table...\n";
    $conn->exec($sql);
    
    echo "Adding Primary Key...\n";
    $conn->exec('alter table "users" add primary key ("id")');
    
    echo "Success!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
