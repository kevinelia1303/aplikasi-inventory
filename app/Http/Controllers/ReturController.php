<?php

namespace App\Http\Controllers;

use App\Models\GudangModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;
use App\Models\TransaksiGudangModel;
use App\Models\line_item_barang_Model;
use App\Models\ListKebutuhanMaklonModel;
use App\Models\PurchaseOrderModel;
use App\Models\TranDetailModel;
use App\Models\TStokModel;
use App\Models\LineItemPOModel;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function __construct()
    {
        $this->TransaksiGudangModel = new TransaksiGudangModel();
        $this->PurchaseOrderModel = new PurchaseOrderModel();
        $this->middleware('auth');
    }

    public function indexreturbeli(Request $request){
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier=$request->id_supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();

        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $returbeli=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $returbeli=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "RR%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('retur.retur pembelian.v_returbeli',compact('returbeli','supplier1'));
    
    }
    public function indexreturjual(Request $request){
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier=$request->id_supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();

        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $returbeli=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $returbeli=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "RS%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('retur.retur penjualan.v_returjual',compact('returbeli','supplier1'));
    
    }
    public function addreturbeli()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "rr%")
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
        $supplier = SupplierModel::all();
        $gudang = GudangModel::all();
        $data = [
            'benang'=> $this->TransaksiGudangModel->BenangallData(),
        ];
        return view('retur.retur pembelian.v_addreturbeli',$data,compact('supplier','kd','gudang'));
    }

    public function addreturjual()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "rs%")
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
        $supplier = SupplierModel::all();
        $gudang = GudangModel::all();
        $data = [
            'fg'=> $this->TransaksiGudangModel->FGallData(),
        ];
        return view('retur.retur penjualan.v_addreturjual',$data,compact('supplier','kd','gudang'));
    }

    public function RetursubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'KURANG',
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'status' => 'ACTIVE',
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
            'id_user' => Request()->id_user
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $kode = [$request->kode_barang[$key]];
            $jumlah = $request->jumlah[$key];
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->id_lokasi[$key];
            $datas->keterangan = $request->keterangan[$key];
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->save();
            //line_item_barang_Model::whereIn('kode_barang', $kode)->update(["ID_GI" => $request->id_Transaksi]);
            // LineItemPOModel::where('id_barang', $request-> id_barang[$key])
            //                         ->where('id_purchaseorder', $request->id_PurchaseOrder)
            //                         ->where('trx_po_detail.keterangan', 'ItemMaklon')
            //                         ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }

        
        return redirect('/returbeli')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function RetursubmitDataJual(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'TAMBAH',
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'status' => 'ACTIVE',
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
            'id_user' => Request()->id_user
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $kode = [$request->kode_barang[$key]];
            $jumlah = $request->jumlah[$key];
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->id_lokasi[$key];
            $datas->keterangan = $request->keterangan[$key];
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->save();
            //line_item_barang_Model::whereIn('kode_barang', $kode)->update(["ID_GI" => $request->id_Transaksi]);
            // LineItemPOModel::where('id_barang', $request-> id_barang[$key])
            //                         ->where('id_purchaseorder', $request->id_PurchaseOrder)
            //                         ->where('trx_po_detail.keterangan', 'ItemMaklon')
            //                         ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }

        
        return redirect('/returjual')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailreturbeli($ID_Transaksi){
        $data = [
            'gitwisting' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        return view('retur.retur pembelian.v_detailreturbeli', $data);
    }

    public function editreturbeli($ID_Transaksi)
    {
        $data = [
            'returbeli' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        $supplier = SupplierModel::all();
        
        return view('retur.retur pembelian.v_editreturbeli', $data,compact('supplier'));
    }

    public function updatereturbeli( $ID_Transaksi)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->TransaksiGudangModel->editData($ID_Transaksi,$data);
        

        return redirect('/returbeli')->with('pesan','Data berhasil diupdate');
    }
}
