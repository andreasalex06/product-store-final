<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'question',
        'answer',
        'admin_id',
        'is_answered'
    ];

    // Relasi: Diskusi milik siapa? (Penanya)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Diskusi dijawab siapa? (Admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
