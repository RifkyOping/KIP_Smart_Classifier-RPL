<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'fakultas',
        'semester',
        'angkatan',
        'ipk',
        'kip',
        'pendapatan',
        'tanggungan',
        'transkrip',
        'sktm',
        'prestasi',
        'bukti_prestasi',
        'status',
        'mahasiswas_id',
    ];
    protected static function newFactory()
    {
        return \Database\Factories\DataTrainingFactory::new();
    }
}
