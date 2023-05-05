<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class line_item_barang_Model extends Model
{
    use HasFactory;
    protected $table = 'line_item_barang';

    protected $fillable = [
        'Kode_Barang',
        'total_Panjang',
        'id_barang',
        'ID_GR',
        'ID_GI',
        'kode_gudang'
    ];

    public function editData($Kode_Barang, $data)
    {
        DB::table('line_item_barang')->where('Kode_Barang',$Kode_Barang)->update($data);
    }
}
