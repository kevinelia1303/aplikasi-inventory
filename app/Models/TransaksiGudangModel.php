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
        'id_sales',
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
                ->join("regencies", function($join){
                    $join->on("supplier.regencies_id", "=", "regencies.id");
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
    public function GreigeallData(){
        return DB::table("barang")
                ->join("satuan", function($join){
	                $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->join("jenis_barang", function($join){
	                $join->on("jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang");
                })
                ->where("id_barang", "like", 'ITJ%')->get();
    }

    public function GIItemdetailData($ID_Transaksi)
    {
        
        return DB::table("line_item_barang")
                ->join("transaksi_gudang", function($join){
                    $join->on("transaksi_gudang.ID_Transaksi", "=", "line_item_barang.ID_GR");
                })
                ->where('line_item_barang.ID_GI', $ID_Transaksi)->get();
    }

    public function FGallData(){
        return DB::table("barang")
                ->join("satuan", function($join){
	                $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->join("jenis_barang", function($join){
	                $join->on("jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang");
                })
                ->where("id_barang", "like", 'F%')->get();
    }

    public function GIPenjualanallData()
    {
        DB::table("transaksi_gudang")
        ->where("id_transaksi", "like", 'jf%')
        ->orderBy("id_transaksi","desc")
        ->get();
    }

    public function itemprintsj($ID_Transaksi)
    {
        return 
            DB::table("line_item_barang")
            ->join("barang", function($join){
                $join->on("line_item_barang.id_barang", "=", "barang.id_barang");
            })
            ->select("barang.keterangan1", "barang.keterangan2", DB::raw("(sum(line_item_barang.total_panjang)) as total_panjang"))
            ->where("id_gi", "=", "'".$ID_Transaksi."'")
            ->groupBy("line_item_barang.id_barang")
            ->get();


    }
}
