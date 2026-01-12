<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    // WAJIB ADA: Agar controller bisa menyimpan data 'name' dan 'image'
    protected $fillable = ['name', 'image'];
}
