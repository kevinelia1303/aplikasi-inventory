<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderModel extends Model
{
    use HasFactory;
    protected $table = 'purchase_order';

    protected $fillable = [
        'id_PurchaseOrder',
        'tanggal',
        'total_harga',
        'status',
        'jenis_bayar',
        'id_user',
        'id_supplier'
    ];

    public function pobenangallData()
    {
        return DB::table("purchase_order")
                ->join("supplier", function($join){
                    $join->on("purchase_order.id_supplier", "=", "supplier.id_supp");
                })
                ->where("purchase_order.id_purchaseorder", "like", "py%")
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
        DB::table('purchase_order')->insert($data);
    }

    public function detailData($id_PurchaseOrder)
    {
        
        return DB::table("purchase_order")
                ->join("supplier", function($join){
                    $join->on("purchase_order.id_supplier", "=", "supplier.id_supp");
                })
                ->where('id_purchaseorder', $id_PurchaseOrder)->first();
    }
    public function ItemdetailData($id_PurchaseOrder)
    {
        
        return DB::table("line_item_po")
                ->join("purchase_order", function($join){
                    $join->on("purchase_order.id_PurchaseOrder", "=", "line_item_po.id_PurchaseOrder");
                })
                ->where('line_item_po.id_purchaseorder', $id_PurchaseOrder)->get();
    }

    public function editData($id_PurchaseOrder, $data)
    {
        DB::table('purchase_order')->where('id_PurchaseOrder',$id_PurchaseOrder)->update($data);
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
}
