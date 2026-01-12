<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    use HasFactory;

    // Tambahkan baris ini sesuai dengan kolom di tabel migration Anda
    protected $fillable = [
        'code',
        'type',
        'value',
        'max_uses',
    ];
}
