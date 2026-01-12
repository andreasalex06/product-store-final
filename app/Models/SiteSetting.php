<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    // Tambahkan baris ini untuk mengizinkan input data ke kolom key dan value
    protected $fillable = ['key', 'value'];
}
