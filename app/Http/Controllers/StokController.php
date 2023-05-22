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
                                ->join("tstok","tstok.ID_BARANG", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                                ->where("tstok.JUMLAH",">",0)
                                ->get();
            $total_roll = TStokModel::where("tstok.JUMLAH",">",0)
                        ->where("ID_BARANG","like",'%'.$id_barang.'%')
                        ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                        ->count('ID_BARANG');
            $total_panjang = TStokModel::where("tstok.JUMLAH",">",0)
                            ->where("ID_BARANG","like",'%'.$id_barang.'%')
                            ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                            ->sum('JUMLAH');
        }else{
            $finished_goods=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("tstok","tstok.ID_BARANG", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'F%')
                                ->where("tstok.JUMLAH",">",0)
                                ->get();
            $total_roll = TStokModel::where("tstok.JUMLAH",">",0)
                        ->where("ID_BARANG","like",'F%')
                        ->count('ID_BARANG');
            $total_panjang = TStokModel::where("tstok.JUMLAH",">",0)
                            ->where("ID_BARANG","like",'F%')
                            ->sum('JUMLAH');
        }
        
        return view('stock information.v_stockfg',compact('finished_goods','total_roll','total_panjang'));
    }

    public function stokbenang(Request $request)
    {
        $id_barang=$request->id_barang;
        $kode_barang=$request->kode_barang;
        if ($id_barang OR $kode_barang  <> "") {
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("tstok","tstok.ID_BARANG", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                                ->where("tstok.JUMLAH",">",0)
                                ->get();
            $total_roll = TStokModel::where("tstok.JUMLAH",">",0)
                        ->where("ID_BARANG","like",'%'.$id_barang.'%')
                        ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                        ->count('ID_BARANG');
            $total_panjang = TStokModel::where("tstok.JUMLAH",">",0)
                            ->where("ID_BARANG","like",'%'.$id_barang.'%')
                            ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                            ->sum('JUMLAH');
        }else{
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("tstok","tstok.ID_BARANG", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'Y%')
                                ->where("tstok.JUMLAH",">",0)
                                ->get();
            $total_roll = TStokModel::where("tstok.JUMLAH",">",0)
                        ->where("ID_BARANG","like",'Y%')
                        ->count('ID_BARANG');
            $total_panjang = TStokModel::where("tstok.JUMLAH",">",0)
                            ->where("ID_BARANG","like",'Y%')
                            ->sum('JUMLAH');
        }
        
        return view('stock information.v_stockbenang',compact('benang','total_roll','total_panjang'));
    }

    public function stokgreige(Request $request)
    {
        $id_barang=$request->id_barang;
        $kode_barang=$request->kode_barang;
        if ($id_barang OR $kode_barang  <> "") {
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("tstok","tstok.ID_BARANG", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                                ->where("tstok.JUMLAH",">",0)
                                ->get();
            $total_roll = TStokModel::where("tstok.JUMLAH",">",0)
                        ->where("ID_BARANG","like",'%'.$id_barang.'%')
                        ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                        ->count('ID_BARANG');
            $total_panjang = TStokModel::where("tstok.JUMLAH",">",0)
                            ->where("ID_BARANG","like",'%'.$id_barang.'%')
                            ->where("tstok.BARCODE","like",'%'.$kode_barang.'%')
                            ->sum('JUMLAH');
        }else{
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("tstok","tstok.ID_BARANG", "=", "barang.id_barang")
                                ->where("barang.id_barang","like",'ITJ%')
                                ->where("tstok.JUMLAH",">",0)
                                ->get();
            $total_roll = TStokModel::where("tstok.JUMLAH",">",0)
                        ->where("ID_BARANG","like",'ITJ%')
                        ->count('ID_BARANG');
            $total_panjang = TStokModel::where("tstok.JUMLAH",">",0)
                            ->where("ID_BARANG","like",'ITJ%')
                            ->sum('JUMLAH');
        }
        
        return view('stock information.v_stockgreige',compact('greige','total_roll','total_panjang'));
    }
}
