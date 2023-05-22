<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KartuStokModel;
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

        $KartuStok = KartuStokModel::where('ID_BARANG',$id_barang)
                        ->whereBetween('TAHUN',[$tahun_awal,$tahun_akhir])
                        ->whereBetween('BULAN',[$bulan_awal,$bulan_akhir])
                        ->get();
        $barang = BarangModel::where('id_barang',$id_barang)
                    ->first();
        // dd($KartuStok);
        
        return view('Laporan.kartu stok.cetak_kartustok', compact('KartuStok','barang'));
    }
}
