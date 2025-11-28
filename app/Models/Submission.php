<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'mahasiswas_id',
        'penhasilan_orangtua',
        'jumlah_tanggungan',
        'no_akunkip',
        'prestasi',
        'sktm',
        'status  ',
    ];
}
