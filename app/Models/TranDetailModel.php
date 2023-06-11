<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranDetailModel extends Model
{
    use HasFactory;
    protected $table = 'trx_gudang_detail';

    protected $fillable = [
        'ID_TRAN',
        'id_barang',
        'id_lokasi',
        'BARCODE',
        'jumlah'
    ];
}
