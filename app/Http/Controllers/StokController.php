<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\line_item_barang_Model;

class StokController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function stokfg(Request $request)
    {
        $id_barang=$request->id_barang;
        $kode_barang=$request->kode_barang;
        if ($id_barang OR $kode_barang  <> "") {
            $finished_goods=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("line_item_barang","line_item_barang.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                                ->whereNull("line_item_barang.ID_GI")
                                ->get();
            $total_roll = line_item_barang_Model::whereNull("id_gi")
                        ->where("id_barang","like",'%'.$id_barang.'%')
                        ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                        ->count('id_barang');
            $total_panjang = line_item_barang_Model::whereNull("id_gi")
                            ->where("id_barang","like",'%'.$id_barang.'%')
                            ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                            ->sum('total_Panjang');
        }else{
            $finished_goods=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("line_item_barang","line_item_barang.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'F%')
                                ->whereNull("line_item_barang.ID_GI")
                                ->get();
            $total_roll = line_item_barang_Model::whereNull("id_gi")
                        ->where("id_barang","like",'F%')
                        ->count('id_barang');
            $total_panjang = line_item_barang_Model::whereNull("id_gi")
                            ->where("id_barang","like",'F%')
                            ->sum('total_Panjang');
        }
        
        return view('stock information.v_stockfg',compact('finished_goods','total_roll','total_panjang'));
    }

    public function stokbenang(Request $request)
    {
        $id_barang=$request->id_barang;
        $kode_barang=$request->kode_barang;
        if ($id_barang OR $kode_barang  <> "") {
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("line_item_barang","line_item_barang.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                                ->whereNull("line_item_barang.ID_GI")
                                ->get();
            $total_roll = line_item_barang_Model::whereNull("id_gi")
                        ->where("id_barang","like",'%'.$id_barang.'%')
                        ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                        ->count('id_barang');
            $total_panjang = line_item_barang_Model::whereNull("id_gi")
                            ->where("id_barang","like",'%'.$id_barang.'%')
                            ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                            ->sum('total_Panjang');
        }else{
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("line_item_barang","line_item_barang.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'Y%')
                                ->whereNull("line_item_barang.ID_GI")
                                ->get();
            $total_roll = line_item_barang_Model::whereNull("id_gi")
                        ->where("id_barang","like",'Y%')
                        ->count('id_barang');
            $total_panjang = line_item_barang_Model::whereNull("id_gi")
                            ->where("id_barang","like",'Y%')
                            ->sum('total_Panjang');
        }
        
        return view('stock information.v_stockbenang',compact('benang','total_roll','total_panjang'));
    }

    public function stokgreige(Request $request)
    {
        $id_barang=$request->id_barang;
        $kode_barang=$request->kode_barang;
        if ($id_barang OR $kode_barang  <> "") {
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("line_item_barang","line_item_barang.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                                ->whereNull("line_item_barang.ID_GI")
                                ->get();
            $total_roll = line_item_barang_Model::whereNull("id_gi")
                        ->where("id_barang","like",'%'.$id_barang.'%')
                        ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                        ->count('id_barang');
            $total_panjang = line_item_barang_Model::whereNull("id_gi")
                            ->where("id_barang","like",'%'.$id_barang.'%')
                            ->where("line_item_barang.kode_barang","like",'%'.$kode_barang.'%')
                            ->sum('total_Panjang');
        }else{
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("line_item_barang","line_item_barang.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'ITJ%')
                                ->whereNull("line_item_barang.ID_GI")
                                ->get();
            $total_roll = line_item_barang_Model::whereNull("id_gi")
                        ->where("id_barang","like",'ITJ%')
                        ->count('id_barang');
            $total_panjang = line_item_barang_Model::whereNull("id_gi")
                            ->where("id_barang","like",'ITJ%')
                            ->sum('total_Panjang');
        }
        
        return view('stock information.v_stockgreige',compact('greige','total_roll','total_panjang'));
    }
}
