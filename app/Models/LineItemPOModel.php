<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineItemPOModel extends Model
{
    use HasFactory;

    protected $table = 'trx_po_detail';

    protected $fillable = [
        'jumlah',
        'harga',
        'TotalHarga',
        'id_barang',
        'id_PurchaseOrder'
    ];
}
