<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangModel extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'id_barang',
        'keterangan1',
        'keterangan2',
        'keterangan3',
        'keterangan4',
        'keterangan5',
        'id_satuan',
        'id_jenis_barang'
    ];

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

    public function FGdetailData($id_barang)
    {
        // return DB::table('barang')->where('id_barang', $id_barang)->first();
        return DB::table("barang")
                ->join("satuan", function($join){
	                $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->join("jenis_barang", function($join){
	                $join->on("jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang");
                })
                ->where('id_barang', $id_barang)->first();
    }
    public function FGeditData($id_barang, $data)
    {
        DB::table('barang')->where('id_barang',$id_barang)->update($data);
    }

    public function FGdeleteData($id_barang)
    {
        DB::table('barang')->where('id_barang',$id_barang)->delete();
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

    public function GreigedetailData($id_barang)
    {
        // return DB::table('barang')->where('id_barang', $id_barang)->first();
        return DB::table("barang")
                ->join("satuan", function($join){
	                $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->join("jenis_barang", function($join){
	                $join->on("jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang");
                })
                ->where('id_barang', $id_barang)->first();
    }

    public function GreigeeditData($id_barang, $data)
    {
        DB::table('barang')->where('id_barang',$id_barang)->update($data);
    }

    public function GreigedeleteData($id_barang)
    {
        DB::table('barang')->where('id_barang',$id_barang)->delete();
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

    public function BenangdetailData($id_barang)
    {
        // return DB::table('barang')->where('id_barang', $id_barang)->first();
        return DB::table("barang")
                ->join("satuan", function($join){
	                $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->join("jenis_barang", function($join){
	                $join->on("jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang");
                })
                ->where('id_barang', $id_barang)->first();
    }

    public function BenangeditData($id_barang, $data)
    {
        DB::table('barang')->where('id_barang',$id_barang)->update($data);
    }

    public function BenangdeleteData($id_barang)
    {
        DB::table('barang')->where('id_barang',$id_barang)->delete();
    }
}