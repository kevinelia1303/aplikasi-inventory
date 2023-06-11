<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\line_item_barang_Model;
use App\Models\TStokModel;

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
                                ->join("trx_stok","trx_stok.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                                ->where("trx_stok.jumlah",">",0)
                                ->get();
            $total_roll = TStokModel::where("trx_stok.jumlah",">",0)
                        ->where("id_barang","like",'%'.$id_barang.'%')
                        ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                        ->count('id_barang');
            $total_panjang = TStokModel::where("trx_stok.jumlah",">",0)
                            ->where("id_barang","like",'%'.$id_barang.'%')
                            ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                            ->sum('jumlah');
        }else{
            $finished_goods=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("trx_stok","trx_stok.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'F%')
                                ->where("trx_stok.jumlah",">",0)
                                ->get();
            $total_roll = TStokModel::where("trx_stok.jumlah",">",0)
                        ->where("id_barang","like",'F%')
                        ->count('id_barang');
            $total_panjang = TStokModel::where("trx_stok.jumlah",">",0)
                            ->where("id_barang","like",'F%')
                            ->sum('jumlah');
        }
        
        return view('stock information.v_stockfg',compact('finished_goods','total_roll','total_panjang'));
    }

    public function stokbenang(Request $request)
    {
        $id_barang=$request->id_barang;
        $kode_barang=$request->kode_barang;
        if ($id_barang OR $kode_barang  <> "") {
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("trx_stok","trx_stok.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                                ->where("trx_stok.jumlah",">",0)
                                ->get();
            $total_roll = TStokModel::where("trx_stok.jumlah",">",0)
                        ->where("id_barang","like",'%'.$id_barang.'%')
                        ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                        ->count('id_barang');
            $total_panjang = TStokModel::where("trx_stok.jumlah",">",0)
                            ->where("id_barang","like",'%'.$id_barang.'%')
                            ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                            ->sum('jumlah');
        }else{
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("trx_stok","trx_stok.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'Y%')
                                ->where("trx_stok.jumlah",">",0)
                                ->get();
            $total_roll = TStokModel::where("trx_stok.jumlah",">",0)
                        ->where("id_barang","like",'Y%')
                        ->count('id_barang');
            $total_panjang = TStokModel::where("trx_stok.jumlah",">",0)
                            ->where("id_barang","like",'Y%')
                            ->sum('jumlah');
        }
        
        return view('stock information.v_stockbenang',compact('benang','total_roll','total_panjang'));
    }

    public function stokgreige(Request $request)
    {
        $id_barang=$request->id_barang;
        $kode_barang=$request->kode_barang;
        if ($id_barang OR $kode_barang  <> "") {
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("trx_stok","trx_stok.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                                ->where("trx_stok.jumlah",">",0)
                                ->get();
            $total_roll = TStokModel::where("trx_stok.jumlah",">",0)
                        ->where("id_barang","like",'%'.$id_barang.'%')
                        ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                        ->count('id_barang');
            $total_panjang = TStokModel::where("trx_stok.jumlah",">",0)
                            ->where("id_barang","like",'%'.$id_barang.'%')
                            ->where("trx_stok.barcode","like",'%'.$kode_barang.'%')
                            ->sum('jumlah');
        }else{
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("trx_stok","trx_stok.id_barang", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'ITJ%')
                                ->where("trx_stok.jumlah",">",0)
                                ->get();
            $total_roll = TStokModel::where("trx_stok.jumlah",">",0)
                        ->where("id_barang","like",'ITJ%')
                        ->count('id_barang');
            $total_panjang = TStokModel::where("trx_stok.jumlah",">",0)
                            ->where("id_barang","like",'ITJ%')
                            ->sum('jumlah');
        }
        
        return view('stock information.v_stockgreige',compact('greige','total_roll','total_panjang'));
    }
}
