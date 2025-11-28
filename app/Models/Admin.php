<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'nama',
        'nidn',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
