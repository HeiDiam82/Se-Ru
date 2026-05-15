<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('booking_id')->primary();
            $table->uuid('user_id');
            $table->uuid('ruko_id');
            $table->integer('duration_months')->default(1);
            $table->text('usage_plan')->nullable();
            $table->string('ktp_proof')->nullable();
            $table->string('transfer_proof')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ruko_id')->references('ruko_id')->on('ruko')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
