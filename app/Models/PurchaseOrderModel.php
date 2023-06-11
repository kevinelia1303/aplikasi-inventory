<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderModel extends Model
{
    use HasFactory;
    protected $table = 'trx_po';

    protected $fillable = [
        'id_PurchaseOrder',
        'tanggal',
        'total_harga',
        'status',
        'jenis_bayar',
        'id_user',
        'id_supplier',
        'created_at',
        'updated_at'
    ];

    public function pobenangallData()
    {
        return DB::table("trx_po")
                ->join("supplier", function($join){
                    $join->on("trx_po.id_supplier", "=", "supplier.id_supp");
                })
                ->where("trx_po.id_purchaseorder", "like", "py%")
                ->get();
    }

    

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
        DB::table('trx_po')->insert($data);
    }

    public function detailData($id_PurchaseOrder)
    {
        
        return DB::table("trx_po")
                ->join("supplier", function($join){
                    $join->on("trx_po.id_supplier", "=", "supplier.id_supp");
                })
                ->where('id_purchaseorder', $id_PurchaseOrder)->first();
    }
    public function ItemdetailData($id_PurchaseOrder)
    {
        
        return DB::table("trx_po_detail")
                ->join("trx_po", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->select('trx_po_detail.*')
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemPO')
                ->get();
    }

    public function editData($id_PurchaseOrder, $data)
    {
        DB::table('trx_po')->where('id_PurchaseOrder',$id_PurchaseOrder)->update($data);
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

    public function ItemMaklondetailData($id_PurchaseOrder)
    {
        
        return DB::table("trx_po_detail")
                ->join("trx_po", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemMaklon')
                ->get();
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
}
