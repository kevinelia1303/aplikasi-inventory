<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransaksiGudangModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi_gudang';

    protected $fillable = [
        'ID_Transaksi',
        'Tanggal',
        'total_panjang',
        'total_roll',
        'id_purchaseorder',
        'id_supp',
        'customer'
    ];

    public function BenangallData(){
        return DB::table("barang")
                ->join("satuan", function($join){
	                $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->join("jenis_barang", function($join){
	                $join->on("jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang");
                })
                ->where("id_barang", "like", 'YA%')->get();
    }

    public function addData($data)
    {
        DB::table('transaksi_gudang')->insert($data);
    }

    public function detailData($ID_Transaksi)
    {
        return DB::table("transaksi_gudang")
                ->join("supplier", function($join){
                    $join->on("transaksi_gudang.id_supp", "=", "supplier.id_supp");
                })
                ->where('ID_Transaksi', $ID_Transaksi)->first();
    }

    public function GRItemdetailData($ID_Transaksi)
    {
        
        return DB::table("line_item_barang")
                ->join("transaksi_gudang", function($join){
                    $join->on("transaksi_gudang.ID_Transaksi", "=", "line_item_barang.ID_GR");
                })
                ->where('line_item_barang.ID_GR', $ID_Transaksi)->get();
    }
}
