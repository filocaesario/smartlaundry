<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'kategori', 'keterangan', 'jumlah'];

    // Ini kunci agar format ->format('d M Y') di Blade tidak error
    protected $casts = [
        'tanggal' => 'date',
    ];
}
