<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_resi',
        'nama_pelanggan',
        'no_wa',
        'alamat',
        'service_id',
        'jumlah_berat',
        'total_harga',
        'status',
        'is_hidden_by_user',
        'is_hidden_by_admin',
        'diskon', 'promo_id',
        'pembayaran_status'
    ];

    // Relasi Belongs-To: 1 Pesanan hanya punya 1 Layanan
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
}
