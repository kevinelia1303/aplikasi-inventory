<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarangModel extends Model
{
    protected $table = 'jenis_barang';

    protected $fillable = [
        'id_jenis_barang',
        'jenis_barang',
    ];
}
