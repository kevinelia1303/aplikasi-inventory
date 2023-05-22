<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuStokModel extends Model
{
    use HasFactory;

    protected $table = 'kartustok';

    protected $fillable = [
        'TAHUN',
        'BULAN',
        'ID_BARANG',
        'KODE_GUDANG',
        'AWAL',
        'AKHIR',
        'MASUK',
        'KELUAR'
    ];
}
