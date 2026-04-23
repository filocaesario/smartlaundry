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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_resi')->unique(); // Generate otomatis LND-XXX
            $table->string('nama_pelanggan');
            $table->string('no_wa');
            $table->text('alamat');
            // Relasi ke tabel services
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->integer('jumlah_berat');
            $table->integer('total_harga')->nullable(); // Harga x jumlah_berat
            $table->enum('status', ['antre', 'dicuci', 'disetrika', 'selesai'])->default('antre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
