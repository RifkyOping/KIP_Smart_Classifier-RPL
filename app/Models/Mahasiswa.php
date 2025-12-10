<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'users_id',
        'nama',
        'nim',
        'fakultas',
        'prodi',
        'jenis_kelamin',
        'no_telepon',
        'semester',
        'angkatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function submission()
    {
        return $this->hasOne(Submission::class, 'mahasiswas_id');
    }
}
