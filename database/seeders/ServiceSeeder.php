<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::insert([
            ['nama_layanan' => 'Cuci Kiloan', 'harga' => 6000, 'satuan' => 'kg'],
            ['nama_layanan' => 'Satuan Premium', 'harga' => 15000, 'satuan' => 'pcs'],
            ['nama_layanan' => 'Cuci Sepatu', 'harga' => 25000, 'satuan' => 'pasang'],
            ['nama_layanan' => 'Cuci Karpet', 'harga' => 10000, 'satuan' => 'meter'],
        ]);
    }
}
