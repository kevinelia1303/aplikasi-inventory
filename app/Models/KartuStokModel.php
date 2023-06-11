<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KartuStokModel extends Model
{
    use HasFactory;

    protected $table = 'kartustok';

    public $timestamps = false;

    protected $fillable = [
        'TAHUN',
        'BULAN',
        'id_barang',
        'KODE_GUDANG',
        'AWAL',
        'AKHIR',
        'MASUK',
        'KELUAR'
    ];

    public function addData($data)
    {
        DB::table('kartustok')->insert($data);
    }
}
