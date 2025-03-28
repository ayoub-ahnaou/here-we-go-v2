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
        Schema::create('reservations', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->nullOnDelete();
            $table->foreignId('annonce_id')->constrained('annonces')->nullOnDelete();
            $table->primary(['user_id', 'annonce_id']);
            $table->date("start_date");
            $table->date("end_date");
            $table->decimal('price_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
