<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TStokModel extends Model
{
    use HasFactory;
    protected $table = 'trx_stok';

    protected $fillable = [
        'BARCODE',
        'jumlah',
        'id_barang',
        'id_lokasi',
        'ID_TRAN'
    ];
}
