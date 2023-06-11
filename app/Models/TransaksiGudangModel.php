<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransaksiGudangModel extends Model
{
    use HasFactory;

    protected $table = 'trx_gudang';

    protected $fillable = [
        'ID_Transaksi',
        'Tanggal',
        'id_sales',
        'total_panjang',
        'total_roll',
        'TRANSAKSI',
        'status',
        'id_purchaseorder',
        'id_supp',
        'customer',
        'no_tlp_cust',
        'alamat_cust',
        'id_user',
        'created_at',
        'updated_at'
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
        DB::table('trx_gudang')->insert($data);
    }

    public function detailData($ID_Transaksi)
    {
        return DB::table("trx_gudang")
                ->join("supplier", function($join){
                    $join->on("trx_gudang.id_supp", "=", "supplier.id_supp");
                })
                ->join("regencies", function($join){
                    $join->on("supplier.regencies_id", "=", "regencies.id");
                })
                ->where('ID_Transaksi', $ID_Transaksi)->first();
    }

    public function sodetailData($ID_Transaksi)
    {
        return DB::table("trx_gudang")
                ->where('ID_Transaksi', $ID_Transaksi)->first();
    }

    public function editData($ID_Transaksi, $data)
    {
        DB::table('trx_gudang')->where('ID_Transaksi',$ID_Transaksi)->update($data);
    }

    public function GRItemdetailData($ID_Transaksi)
    {
        
        return DB::table("trx_gudang_detail")
                ->join("trx_gudang", function($join){
                    $join->on("trx_gudang.ID_Transaksi", "=", "trx_gudang_detail.ID_TRAN");
                })
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)->get();
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
        
        return DB::table("trx_gudang_detail")
                ->join("trx_gudang", function($join){
                    $join->on("trx_gudang.ID_Transaksi", "=", "trx_gudang_detail.ID_TRAN");
                })
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)->get();
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
        DB::table("trx_gudang")
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
