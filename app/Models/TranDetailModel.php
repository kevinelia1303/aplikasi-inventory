<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranDetailModel extends Model
{
    use HasFactory;
    protected $table = 'tdetail_tran_bar';

    protected $fillable = [
        'ID_TRAN',
        'ID_BARANG',
        'ID_LOKASI',
        'BARCODE',
        'JUMLAH'
    ];
}
