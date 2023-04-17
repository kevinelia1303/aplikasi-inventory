<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKebutuhanMaklonModel extends Model
{
    use HasFactory;

    protected $table = 'list_kebutuhan_maklon';

    protected $fillable = [
        'id_barang',
        'harga',
        'id_purchaseorder',
        'jumlah',
        'sisa'
    ];
}
