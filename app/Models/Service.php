<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['nama_layanan', 'harga', 'satuan'];

    // Relasi One-to-Many: 1 Layanan bisa dimiliki banyak Pesanan
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
