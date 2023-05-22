<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TStokModel extends Model
{
    use HasFactory;
    protected $table = 'tstok';

    protected $fillable = [
        'BARCODE',
        'JUMLAH',
        'ID_BARANG',
        'ID_LOKASI',
        'ID_TRAN'
    ];
}
