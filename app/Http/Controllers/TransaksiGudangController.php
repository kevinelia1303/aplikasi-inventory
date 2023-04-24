<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;
use App\Models\TransaksiGudangModel;
use App\Models\line_item_barang_Model;


class TransaksiGudangController extends Controller
{
    public function __construct()
    {
        $this->TransaksiGudangModel = new TransaksiGudangModel();
        // $this->middleware('auth');
    }

    public function indexgrbenang(Request $request)
    {
        
        // return $request->all();
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier=$request->id_supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();
        //filter by id
        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $grbenang=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("transaksi_gudang.ID_Transaksi","asc")
                ->get();
            
        }else{
            $grbenang=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "ry%")
                ->orderBy("transaksi_gudang.ID_Transaksi","asc")
                ->get();
        }
        return view('Goods Receipt.GR benang.v_gr_benang',compact('grbenang','supplier1'));
    }

    public function addgrbenang()
    {
        $supplier = SupplierModel::all();
        $data = [
            'benang'=> $this->TransaksiGudangModel->BenangallData(),
        ];
        return view('Goods Receipt.GR benang.v_gr_addbenang',$data,compact('supplier'));
    }

    public function GrBenangsubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'id_purchaseorder' => Request()->id_PurchaseOrder,
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $datas = new line_item_barang_Model();
            $datas->Kode_Barang =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->total_Panjang = $request->jumlah[$key];
            $datas->ID_GR = $request->id_Transaksi;
            $datas->save();
        }
        return redirect('/grpobenang')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgrbenang($ID_Transaksi){
        $data = [
            'grpobenang' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GRItemdetailData($ID_Transaksi),
        ];
        return view('Goods Receipt.GR benang.v_gr_detailbenang', $data);
    }

    public function indexgrgreige(Request $request)
    {
        
        // return $request->all();
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier=$request->id_supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();
        //filter by id
        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $grgreige=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("transaksi_gudang.ID_Transaksi","asc")
                ->get();
            
        }else{
            $grgreige=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "rg%")
                ->orderBy("transaksi_gudang.ID_Transaksi","asc")
                ->get();
        }
        return view('Goods Receipt.GR Greige.v_gr_greige',compact('grgreige','supplier1'));
    }

    public function addgrgreige()
    {
        $supplier = SupplierModel::all();
        $data = [
            'greige'=> $this->TransaksiGudangModel->GreigeallData(),
        ];
        return view('Goods Receipt.GR Greige.v_gr_addgreige',$data,compact('supplier'));
    }

    public function GrGreigesubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'id_purchaseorder' => Request()->id_PurchaseOrder,
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $datas = new line_item_barang_Model();
            $datas->Kode_Barang =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->total_Panjang = $request->jumlah[$key];
            $datas->ID_GR = $request->id_Transaksi;
            $datas->save();
        }
        return redirect('/grpogreige')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgrgreige($ID_Transaksi){
        $data = [
            'grpogreige' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GRItemdetailData($ID_Transaksi),
        ];
        return view('Goods Receipt.GR Greige.v_gr_detailgreige', $data);
    }

    public function indexgitwisting(Request $request)
    {
        
        // return $request->all();
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier=$request->id_supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();
        //filter by id
        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $gitwisting=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("transaksi_gudang.ID_Transaksi","asc")
                ->get();
            
        }else{
            $gitwisting=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "dm%")
                ->orderBy("transaksi_gudang.ID_Transaksi","asc")
                ->get();
        }
        return view('Goods Issue.GI twisting.v_gi_twisting',compact('gitwisting','supplier1'));
    }

    public function addgitwisting(Request $request)
    {
        $supplier = SupplierModel::all();
        
        // $data = [
        //     'greige'=> $this->TransaksiGudangModel->GreigeallData(),
        // ];
        return view('Goods Issue.GI twisting.v_gi_addtwisting',compact('supplier'));
    }

    public function ajax(Request $request)
    {
        $kode_barang['kode_barang'] = $request->kode_barang;
        $ajax_barang = line_item_barang_Model::where('kode_barang', $kode_barang)->get();

        return view('Goods Issue.GI twisting.ajax', compact('ajax_barang'));
    }

    public function ajax1(Request $request)
    {
        $kode_barang['kode_barang'] = $request->kode_barang;
        $ajax_barang = line_item_barang_Model::where('kode_barang', $kode_barang)->get();

        return view('Goods Issue.GI twisting.ajax_panjang', compact('ajax_barang'));
    }
}
