<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // Contoh: DISKON20, JUMATBERKAH
            $table->integer('diskon_persen'); // Contoh: 10, 20, 50 (dalam persen)
            $table->string('deskripsi')->nullable();
            $table->integer('kuota'); // Berapa kali voucher bisa dipakai
            $table->boolean('is_active')->default(true); // Status nyala/mati
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
