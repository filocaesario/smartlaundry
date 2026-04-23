<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['kode', 'diskon_persen', 'kuota', 'is_active'];
}
