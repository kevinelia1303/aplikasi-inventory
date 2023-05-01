<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;
use App\Models\TransaksiGudangModel;
use App\Models\line_item_barang_Model;
use App\Models\ListKebutuhanMaklonModel;
use Illuminate\Support\Facades\DB;

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
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grbenang=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "ry%")
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
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
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grgreige=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "rg%")
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
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
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $gitwisting=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "dm%")
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Issue.GI twisting.v_gi_twisting',compact('gitwisting','supplier1'));
    }

    public function addgitwisting(Request $request)
    {
        $supplier = SupplierModel::all();
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

    public function GiTwistingsubmitData(Request $request)
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
            $kode = [$request->kode_barang[$key]];
            $jumlah = $request->jumlah[$key];
            line_item_barang_Model::whereIn('kode_barang', $kode)->update(["ID_GI" => $request->id_Transaksi]);
            ListKebutuhanMaklonModel::whereIn('id_barang', $request-> id_barang)
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }

        
        return redirect('/gitwisting')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgitwisting($ID_Transaksi){
        $data = [
            'gitwisting' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        return view('Goods Issue.GI twisting.v_gi_detailtwisting', $data);
    }

    public function indexgrtwisting(Request $request)
    {
        
        // return $request->all();
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier = $request->supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();
        //filter by id
        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $grtwisting=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grtwisting=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "rm%")
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Receipt.GR Twisting.v_gr_twisting',compact('grtwisting','supplier1'));
    }

    public function addgrtwisting()
    {
        $supplier = SupplierModel::all();
        $data = [
            'greige'=> $this->TransaksiGudangModel->GreigeallData(),
        ];
        return view('Goods Receipt.GR Twisting.v_gr_addtwisting',$data,compact('supplier'));
    }

    public function GrTwistingsubmitData(Request $request)
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
        return redirect('/grtwisting')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgrtwisting($ID_Transaksi){
        $data = [
            'grtwisting' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GRItemdetailData($ID_Transaksi),
        ];
        return view('Goods Receipt.GR Twisting.v_gr_detailtwisting', $data);
    }

    public function indexgidf(Request $request)
    {
        
        // return $request->all();
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier=$request->id_supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();
        //filter by id
        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $gidf=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $gidf=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "df%")
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Issue.GI DF.v_gi_dyeingfinishing',compact('gidf','supplier1'));
    }

    public function addgidf(Request $request)
    {
        $supplier = SupplierModel::all();
        return view('Goods Issue.GI DF.v_gi_adddf',compact('supplier'));
    }

    public function ajax2(Request $request)
    {
        $kode_barang['kode_barang'] = $request->kode_barang;
        $ajax_barang = line_item_barang_Model::where('kode_barang', $kode_barang)->get();

        return view('Goods Issue.GI DF.ajax', compact('ajax_barang'));
    }

    public function ajax3(Request $request)
    {
        $kode_barang['kode_barang'] = $request->kode_barang;
        $ajax_barang = line_item_barang_Model::where('kode_barang', $kode_barang)->get();

        return view('Goods Issue.GI DF.ajax_panjang', compact('ajax_barang'));
    }

    public function GiDFsubmitData(Request $request)
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
            $kode = [$request->kode_barang[$key]];
            $jumlah = $request->jumlah[$key];
            line_item_barang_Model::whereIn('kode_barang', $kode)->update(["ID_GI" => $request->id_Transaksi]);
            ListKebutuhanMaklonModel::whereIn('id_barang', $request-> id_barang)
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }

        
        return redirect('/gidf')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgidf($ID_Transaksi){
        $data = [
            'gidf' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        return view('Goods Issue.GI DF.v_gi_detaildf', $data);
    }

    public function indexgrdf(Request $request)
    {
        
        // return $request->all();
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $supplier = $request->supplier;
        $id_PurchaseOrder=$request->id_PurchaseOrder;
        $supplier1 = SupplierModel::all();
        //filter by id
        if($ID_Transaksi OR $id_PurchaseOrder OR $tanggal OR $supplier <> ""){
            $grdf=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grdf=TransaksiGudangModel::join('supplier', 'transaksi_gudang.id_supp','=','supplier.id_supp')
                ->where("transaksi_gudang.ID_Transaksi", "like", "rj%")
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Receipt.GR DF.v_gr_dyeingfinishing',compact('grdf','supplier1'));
    }

    public function addgrdf()
    {
        $supplier = SupplierModel::all();
        $data = [
            'fg'=> $this->TransaksiGudangModel->FGallData(),
        ];
        return view('Goods Receipt.GR DF.v_gr_adddf',$data,compact('supplier'));
    }

    public function GrDFsubmitData(Request $request)
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
        return redirect('/grdyeingfinishing')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgrdf($ID_Transaksi){
        $data = [
            'grdf' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GRItemdetailData($ID_Transaksi),
        ];
        return view('Goods Receipt.GR DF.v_gr_detaildf', $data);
    }

    public function indexgipenjualan(Request $request)
    {
        
        // return $request->all();
        $ID_Transaksi=$request->ID_Transaksi;
        $tanggal=$request->tanggal;
        $customer=$request->customer;
        $id_sales=$request->id_sales;
        //filter by id
        if($ID_Transaksi OR $id_sales OR $tanggal OR $customer <> ""){
            $gipenjualan=TransaksiGudangModel::where("transaksi_gudang.ID_Transaksi", "like", "jf%")
                ->where("transaksi_gudang.customer", "LIKE", '%'.$customer.'%')
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.id_sales", "like", '%'.$id_sales.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $gipenjualan=TransaksiGudangModel::where("transaksi_gudang.ID_Transaksi", "like", "jf%")
                ->orderBy("transaksi_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Issue.GI Penjualan.v_gi_penjualan',compact('gipenjualan'));
    }

    public function addgipenjualan(Request $request)
    {
        $supplier = SupplierModel::all();
        return view('Goods Issue.GI Penjualan.v_gi_addpenjualan',compact('supplier'));
    }

    public function ajax4(Request $request)
    {
        $kode_barang['kode_barang'] = $request->kode_barang;
        $ajax_barang = line_item_barang_Model::where('kode_barang', $kode_barang)->get();

        return view('Goods Issue.GI Penjualan.ajax', compact('ajax_barang'));
    }

    public function ajax5(Request $request)
    {
        $kode_barang['kode_barang'] = $request->kode_barang;
        $ajax_barang = line_item_barang_Model::where('kode_barang', $kode_barang)->get();

        return view('Goods Issue.GI Penjualan.ajax_panjang', compact('ajax_barang'));
    }

    public function GiPenjualansubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'id_sales' => Request()->id_sales,
            'Tanggal' => Request()->tanggal,
            'customer' => Request()->customer,
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $kode = [$request->kode_barang[$key]];
            line_item_barang_Model::whereIn('kode_barang', $kode)->update(["ID_GI" => $request->id_Transaksi]);
        }

        
        return redirect('/gipenjualan')->with('pesan', 'Data Berhasil Disimpan');
    }
}
