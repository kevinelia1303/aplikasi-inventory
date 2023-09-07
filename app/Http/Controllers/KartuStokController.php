<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KartuStokModel;
use App\Models\TranDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuStokController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexkartustok(Request $request){
        $KartuStok = KartuStokModel::All();
        $barang = BarangModel::All();
        return view('Laporan.kartu stok.v_kartustok', compact('KartuStok','barang'));
    }

    public function hitungkartustok(Request $request){
        $tanggal_awal=$request->tanggal_awal;
        $tanggal_akhir=$request->tanggal_akhir;
        DB::select('CALL HITUNGSEMUA("'.$tanggal_awal.'","'.$tanggal_akhir.'","RM1")');
        $KartuStok = KartuStokModel::All();
        $barang = BarangModel::All();
        return view('Laporan.kartu stok.v_kartustok',compact('KartuStok','barang'))->with('pesan', 'Data Kartu Stok Berhasil Dihitung');
    }

    public function cetak(Request $request){
        $id_barang = $request->id_barang;
        $tahun_awal = $request->tahun_awal;
        $bulan_awal = $request->bulan_awal;
        $tahun_akhir = $request->tahun_akhir;
        $bulan_akhir = $request->bulan_akhir;

        $KartuStok = KartuStokModel::where('id_barang',$id_barang)
                        ->whereBetween('TAHUN',[$tahun_awal,$tahun_akhir])
                        ->whereBetween('BULAN',[$bulan_awal,$bulan_akhir])
                        ->get();
        $barang = BarangModel::where('id_barang',$id_barang)
                    ->first();
        // dd($KartuStok);
        
        return view('Laporan.kartu stok.cetak_kartustok', compact('KartuStok','barang'));
    }

    public function detail($tahun,$bulan,$id_barang){
        $detail = KartuStokModel::where('id_barang',$id_barang)
                        ->where('TAHUN',$tahun)
                        ->where('BULAN',$bulan)
                        ->first();
        $gr = TranDetailModel::join('trx_gudang', 'trx_gudang.ID_Transaksi','=','trx_gudang_detail.id_tran')
                ->select("trx_gudang_detail.id_tran", "trx_gudang.Tanggal", "trx_gudang_detail.id_barang", DB::raw("(sum(trx_gudang_detail.jumlah)) as total"))
                ->where('trx_gudang_detail.id_tran', "like", "R%")
                ->where('trx_gudang_detail.id_barang',$id_barang)
                ->whereYear('trx_gudang.Tanggal', '=', $tahun)
                ->whereMonth('trx_gudang.Tanggal', '=', $bulan)
                ->groupBy("trx_gudang_detail.id_tran")
                ->distinct()
                ->get();

        $gi = TranDetailModel::join('trx_gudang', 'trx_gudang.ID_Transaksi','=','trx_gudang_detail.id_tran')
                ->select("trx_gudang_detail.id_tran", "trx_gudang.Tanggal", "trx_gudang_detail.id_barang", DB::raw("(sum(trx_gudang_detail.jumlah)) as total"))
                ->where('trx_gudang_detail.id_tran', "not like", "R%")
                ->where('trx_gudang_detail.id_tran', "not like", "S%")
                ->where('trx_gudang_detail.id_barang',$id_barang)
                ->whereYear('trx_gudang.Tanggal', '=', $tahun)
                ->whereMonth('trx_gudang.Tanggal', '=', $bulan)
                ->groupBy("trx_gudang_detail.id_tran")
                ->distinct()
                ->get();
        return view('Laporan.kartu stok.v_detailkartustok', compact('detail','gr','gi'));
    }
}
