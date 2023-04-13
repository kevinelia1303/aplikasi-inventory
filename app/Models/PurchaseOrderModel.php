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

    public function allData()
    {
        return DB::table("purchase_order")
                ->join("users", function($join){
                    $join->on("purchase_order.id_user", "=", "users.id");
                })
                ->join("supplier", function($join){
                    $join->on("purchase_order.id_supplier", "=", "supplier.id_supp");
                })
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

    public function BenangaddData($data)
    {
        DB::table('purchase_order')->insert($data);
    }
}
