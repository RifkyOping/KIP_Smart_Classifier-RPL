<?php

function kategoriPendapatan($pendapatan)
{
    return match($pendapatan) {
        '<1jt'  => 'Sangat Rendah',
        '1-2jt' => 'Rendah',
        '2-3jt' => 'Sedang',
        default => 'Tinggi',
    };
}

function kategoriTanggungan($t)
{
    return match(true) {
        $t <= 2  => 'Sedikit',
        $t <= 4  => 'Sedang',
        default  => 'Banyak',
    };
}
