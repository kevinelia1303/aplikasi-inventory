<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SupplierModel extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
        'id_supplier',
        'nama_supplier',
        'alamat',
        'no_telepon',
        'contact_person',
        'regencies_id',
        'province_id',
        'created_at',
        'updated_at'
    ];

    public function allData()
    {
        return DB::table("supplier")
                ->join("provinces", function($join){
                    $join->on("supplier.province_id", "=", "provinces.id");
                })
                ->join("regencies", function($join){
                    $join->on("supplier.regencies_id", "=", "regencies.id");
                })
                ->get();
    }

    public function detailData($id)
    {
        return DB::table("supplier")
                ->join("provinces", function($join){
                    $join->on("supplier.province_id", "=", "provinces.id");
                })
                ->join("regencies", function($join){
                    $join->on("supplier.regencies_id", "=", "regencies.id");
                })
                ->where("supplier.id_supp", $id)
                ->first();
    }

     public function editData($id, $data)
    {
        DB::table('supplier')->where('id_supp',$id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('supplier')->where('id_supp',$id)->delete();
    }
}
