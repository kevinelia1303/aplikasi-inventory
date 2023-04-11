<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GudangModel extends Model
{
    use HasFactory;

    protected $table = 'Gudang';

    protected $fillable = [
        'kode_gudang',
        'nama_gudang',
        'alamat',
        'id_kota',
        'regencies_id',
        'province_id'
    ];

    public function allData()
    {
        return DB::table("Gudang")
                ->join("provinces", function($join){
                    $join->on("Gudang.province_id", "=", "provinces.id");
                })
                ->join("regencies", function($join){
                    $join->on("Gudang.regencies_id", "=", "regencies.id");
                })
                ->get();
    }

    public function addData($data)
    {
        DB::table('Gudang')->insert($data);
    }

    public function detailData($kode_gudang)
    {
        return DB::table("Gudang")
                ->join("provinces", function($join){
                    $join->on("Gudang.province_id", "=", "provinces.id");
                })
                ->join("regencies", function($join){
                    $join->on("Gudang.regencies_id", "=", "regencies.id");
                })
                ->where("Gudang.kode_gudang", $kode_gudang)
                ->first();
    }

    public function editData($kode_gudang, $data)
    {
        DB::table('Gudang')->where('kode_gudang',$kode_gudang)->update($data);
    }

    public function deleteData($kode_gudang)
    {
        DB::table('Gudang')->where('kode_gudang',$kode_gudang)->delete();
    }
}
