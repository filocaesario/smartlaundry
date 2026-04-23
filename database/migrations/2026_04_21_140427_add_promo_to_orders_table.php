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
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('diskon')->default(0)->after('jumlah_berat');
            // Menyimpan info promo apa yang dipakai
            $table->foreignId('promo_id')->nullable()->constrained('promos')->nullOnDelete()->after('diskon');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['promo_id']);
            $table->dropColumn(['diskon', 'promo_id']);
        });
    }
};
