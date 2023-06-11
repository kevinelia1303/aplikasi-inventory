<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiGudangModel;
use App\Models\KartuStokModel;
use Illuminate\Support\Facades\DB;
use App\Models\GudangModel;
use App\Models\BarangModel;
use App\Models\TranDetailModel;

class StockOpnameController extends Controller
{
    public function __construct()
    {
        $this->TransaksiGudangModel = new TransaksiGudangModel();
        $this->KartuStokModel = new KartuStokModel();
        $this->middleware('auth');
    }

    public function indexso()
    {
        $so=TransaksiGudangModel::where("trx_gudang.ID_Transaksi", "like", "sg%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        return view('Laporan.stock opname.v_stockopname',compact('so'));
    }

    public function addso()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "SG%")
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun);
        $kd = "";
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else{
            $kd= "001";
        }
        $barang = BarangModel::all();
        $gudang = GudangModel::all();
        return view('Laporan.stock opname.v_addstockopname',compact('kd','barang','gudang'));
    }

    public function SOsubmitData(Request $request)
    {
        

        TransaksiGudangModel::create([
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'TAMBAH',
            'status' => 'ACTIVE',
            'Tanggal' => Request()->tanggal,
            'total_panjang' => Request()->total_panjang,
            'id_user' => Request()->id_user
        ]);

        KartuStokModel::create([
            'TAHUN' => '2023',
            'BULAN' => '5',
            'id_barang' => Request()->id_barangg,
            'KODE_GUDANG' => Request()->id_lokasi,
            'AKHIR' => Request()->total_panjang  
        ]);
        
        
        foreach($request->kode_barang as $key=>$kode_barang){
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barangg;
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->id_lokasi;
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->save();
        }
        return redirect('/stokopname')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailso($ID_Transaksi){
        $data = [
            'so' =>$this->TransaksiGudangModel->sodetailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GRItemdetailData($ID_Transaksi),
        ];
        return view('Laporan.stock opname.v_detailstockopname', $data);
    }
    
}
