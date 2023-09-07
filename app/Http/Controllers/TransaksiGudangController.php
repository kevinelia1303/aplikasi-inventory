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

class TransaksiGudangController extends Controller
{
    public function __construct()
    {
        $this->TransaksiGudangModel = new TransaksiGudangModel();
        $this->PurchaseOrderModel = new PurchaseOrderModel();
        $this->middleware('auth');
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
            $grbenang=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grbenang=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "ry%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Receipt.GR benang.v_gr_benang',compact('grbenang','supplier1'));
    }

    public function addgrbenang($id_PurchaseOrder)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "ry%")
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
        $purchase = PurchaseOrderModel::join('supplier', 'trx_po.id_supplier','=','supplier.id_supp')
                        ->where('id_PurchaseOrder',$id_PurchaseOrder)
                        ->first();
        $supplier = SupplierModel::all();
        $gudang = GudangModel::all();
        $data = [
            'benang'=> $this->TransaksiGudangModel->BenangallData(),
        ];
        $item = PurchaseOrderModel::join("trx_po_detail", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->select('trx_po_detail.*')
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemPO')
                ->get();
        return view('Goods Receipt.GR benang.v_gr_addbenang',$data,compact('purchase','supplier','kd','gudang','item'));
    }

    public function addgrbenang1()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "ry%")
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
        return view('Goods Receipt.GR benang.v_gr_addbenang',$data,compact('supplier','kd','gudang'));
    }

    public function GrBenangsubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'TAMBAH',
            'status' => 'ACTIVE',
            'id_purchaseorder' => Request()->id_PurchaseOrder,
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
            'id_user' => Request()->id_user,
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $jumlah = $request->jumlah[$key];
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->kode_gudang[$key];
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->keterangan = $request->keterangan[$key];
            $datas->save();
            LineItemPOModel::where('id_barang', $request-> id_barang[$key])
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->where('trx_po_detail.keterangan', 'ItemPO')
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }
        $bulan = date('m');
        $year = date('Y');
        DB::select('CALL HITUNGAWAL1("'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNG1("R%","'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNGSALDO("'.$year.'","'.$bulan.'","RM1")');
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
            $grgreige=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grgreige=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "rg%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Receipt.GR Greige.v_gr_greige',compact('grgreige','supplier1'));
    }

    public function addgrgreige($id_PurchaseOrder)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "rg%")
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
        $purchase = PurchaseOrderModel::join('supplier', 'trx_po.id_supplier','=','supplier.id_supp')
                        ->where('id_PurchaseOrder',$id_PurchaseOrder)
                        ->first();
        $supplier = SupplierModel::all();
        $gudang = GudangModel::all();
        $data = [
            'greige'=> $this->TransaksiGudangModel->GreigeallData(),
        ];
        $item = PurchaseOrderModel::join("trx_po_detail", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->select('trx_po_detail.*')
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemPO')
                ->get();
        return view('Goods Receipt.GR Greige.v_gr_addgreige',$data,compact('item','purchase','supplier','kd','gudang'));
    }

    public function GrGreigesubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'TAMBAH',
            'id_purchaseorder' => Request()->id_PurchaseOrder,
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
            'id_user' => Request()->id_user,
            'status' => 'ACTIVE',
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $jumlah = $request->jumlah[$key];
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->kode_gudang[$key];
            $datas->keterangan = $request->keterangan[$key];
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->save();
            LineItemPOModel::where('id_barang', $request-> id_barang[$key])
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->where('trx_po_detail.keterangan', 'ItemPO')
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }
        $bulan = date('m');
        $year = date('Y');
        DB::select('CALL HITUNGAWAL1("'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNG1("R%","'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNGSALDO("'.$year.'","'.$bulan.'","RM1")');
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
            $gitwisting=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $gitwisting=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "dm%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Issue.GI twisting.v_gi_twisting',compact('gitwisting','supplier1'));
    }

    public function addgitwisting(Request $request,$id_PurchaseOrder)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(ID_Transaksi,3)) as kode'))
                ->where("ID_Transaksi", "like", "dm%")
                ->whereMonth('Tanggal', $bulan)
                ->whereYear('Tanggal', $tahun);
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
        $purchase = PurchaseOrderModel::join('supplier', 'trx_po.id_supplier','=','supplier.id_supp')
                        ->where('id_PurchaseOrder',$id_PurchaseOrder)
                        ->first();
        $supplier = SupplierModel::all();
        $item = PurchaseOrderModel::join("trx_po_detail", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->select('trx_po_detail.*')
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemMaklon')
                ->get();
        return view('Goods Issue.GI twisting.v_gi_addtwisting',compact('item','purchase','supplier','kd'));
    }

    public function ajax(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_barang = TStokModel::where('barcode', $kode_barang)->get();

        return view('Goods Issue.GI twisting.ajax', compact('ajax_barang'));
    }

    public function ajax1(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_barang = TStokModel::where('barcode', $kode_barang)->get();

        return view('Goods Issue.GI twisting.ajax_panjang', compact('ajax_barang'));
    }

    public function GiTwistingsubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'KURANG',
            'id_purchaseorder' => Request()->id_PurchaseOrder,
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
            LineItemPOModel::where('id_barang', $request-> id_barang[$key])
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->where('trx_po_detail.keterangan', 'ItemMaklon')
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }
        $bulan = date('m');
        $year = date('Y');
        DB::select('CALL HITUNGAWAL1("'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNG1("DM%","'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNGSALDO("'.$year.'","'.$bulan.'","RM1")');
        
        return redirect('/gitwisting')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgitwisting($ID_Transaksi){
        $data = [
            'gitwisting' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        return view('Goods Issue.GI twisting.v_gi_detailtwisting', $data);
    }

    public function editgitwisting($ID_Transaksi)
    {
        $data = [
            'gitwisting' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        $supplier = SupplierModel::all();
        
        return view('Goods Issue.GI twisting.v_gi_edittwisting', $data,compact('supplier'));
    }

    public function updategitwisting( $ID_Transaksi)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->TransaksiGudangModel->editData($ID_Transaksi,$data);
        

        return redirect('/gitwisting')->with('pesan','Data berhasil diupdate');
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
            $grtwisting=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grtwisting=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "rm%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Receipt.GR Twisting.v_gr_twisting',compact('grtwisting','supplier1'));
    }

    public function addgrtwisting($id_PurchaseOrder)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "rm%")
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
        $purchase = PurchaseOrderModel::join('supplier', 'trx_po.id_supplier','=','supplier.id_supp')
                        ->where('id_PurchaseOrder',$id_PurchaseOrder)
                        ->first();
        $supplier = SupplierModel::all();
        $gudang = GudangModel::all();
        $data = [
            'greige'=> $this->TransaksiGudangModel->GreigeallData(),
        ];
        $item = PurchaseOrderModel::join("trx_po_detail", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->select('trx_po_detail.*')
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemPO')
                ->get();
        return view('Goods Receipt.GR Twisting.v_gr_addtwisting',$data,compact('item','purchase','supplier','kd','gudang'));
    }

    public function GrTwistingsubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'id_purchaseorder' => Request()->id_PurchaseOrder,
            'TRANSAKSI' => 'TAMBAH',
            'status' => 'ACTIVE',
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
            'id_user' => Request()->id_user
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $jumlah = $request->jumlah[$key];
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->kode_gudang[$key];
            $datas->keterangan = $request->keterangan[$key];
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->save();
            LineItemPOModel::where('id_barang', $request-> id_barang[$key])
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->where('trx_po_detail.keterangan', 'ItemPO')
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }
        $bulan = date('m');
        $year = date('Y');
        DB::select('CALL HITUNGAWAL1("'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNG1("R%","'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNGSALDO("'.$year.'","'.$bulan.'","RM1")');
    
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
            $gidf=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $gidf=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "df%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Issue.GI DF.v_gi_dyeingfinishing',compact('gidf','supplier1'));
    }

    public function addgidf(Request $request, $id_PurchaseOrder)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(ID_Transaksi,3)) as kode'))
                ->where("ID_Transaksi", "like", "df%")
                ->whereMonth('Tanggal', $bulan)
                ->whereYear('Tanggal', $tahun);
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
        $purchase = PurchaseOrderModel::join('supplier', 'trx_po.id_supplier','=','supplier.id_supp')
                        ->where('id_PurchaseOrder',$id_PurchaseOrder)
                        ->first();
        $supplier = SupplierModel::all();
        $item = PurchaseOrderModel::join("trx_po_detail", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->select('trx_po_detail.*')
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemMaklon')
                ->get();
        return view('Goods Issue.GI DF.v_gi_adddf',compact('item','purchase','supplier','kd','item'));
    }

    public function ajax2(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_barang = TStokModel::where('barcode', $kode_barang)->get();

        return view('Goods Issue.GI DF.ajax', compact('ajax_barang'));
    }

    public function ajax3(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_barang = TStokModel::where('barcode', $kode_barang)->get();

        return view('Goods Issue.GI DF.ajax_panjang', compact('ajax_barang'));
    }

    public function ajaxlokasi(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_lokasi = TStokModel::where('barcode', $kode_barang)->get();

        return view('Goods Issue.ajax_lokasi', compact('ajax_lokasi'));
    }

    public function ajaxtanggal(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_tanggal = TStokModel::join('trx_gudang', 'trx_gudang.ID_Transaksi','=','trx_stok.ID_TRAN')
                        ->where('barcode', $kode_barang)->get();

        return view('Goods Issue.ajax_tanggal', compact('ajax_tanggal'));
    }

    public function ajaxketerangan(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_keterangan = TStokModel::join('trx_gudang', 'trx_gudang.ID_Transaksi','=','trx_stok.ID_TRAN')
                        ->where('barcode', $kode_barang)->get();

        return view('Goods Issue.ajax_keterangan', compact('ajax_keterangan'));
    }

    public function GiDFsubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'KURANG',
            'status' => 'ACTIVE',
            'id_purchaseorder' => Request()->id_PurchaseOrder,
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
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
            LineItemPOModel::where('id_barang', $request-> id_barang[$key])
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->where('trx_po_detail.keterangan', 'ItemMaklon')
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }

        $bulan = date('m');
        $year = date('Y');
        DB::select('CALL HITUNGAWAL1("'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNG1("DF%","'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","RM1")');
        DB::select('CALL HITUNGSALDO("'.$year.'","'.$bulan.'","RM1")');
        
        return redirect('/gidf')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgidf($ID_Transaksi){
        $data = [
            'gidf' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        return view('Goods Issue.GI DF.v_gi_detaildf', $data);
    }

    public function editgidf($ID_Transaksi)
    {
        $data = [
            'gidf' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        
        return view('Goods Issue.GI DF.v_gi_editdf',  $data);
    }

    public function updategidf( $ID_Transaksi)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->TransaksiGudangModel->editData($ID_Transaksi,$data);
        

        return redirect('/gidf')->with('pesan','Data berhasil diupdate');
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
            $grdf=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.id_supp", "LIKE", '%'.$supplier.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_purchaseorder", "like", '%'.$id_PurchaseOrder.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $grdf=TransaksiGudangModel::join('supplier', 'trx_gudang.id_supp','=','supplier.id_supp')
                ->where("trx_gudang.ID_Transaksi", "like", "rj%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Receipt.GR DF.v_gr_dyeingfinishing',compact('grdf','supplier1'));
    }

    public function addgrdf($id_PurchaseOrder)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(id_Transaksi,3)) as kode'))
                ->where("id_Transaksi", "like", "rj%")
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
        $purchase = PurchaseOrderModel::join('supplier', 'trx_po.id_supplier','=','supplier.id_supp')
                        ->where('id_PurchaseOrder',$id_PurchaseOrder)
                        ->first();
        $supplier = SupplierModel::all();
        $gudang = GudangModel::all();
        $data = [
            'fg'=> $this->TransaksiGudangModel->FGallData(),
        ];
        $item = PurchaseOrderModel::join("trx_po_detail", function($join){
                    $join->on("trx_po.id_PurchaseOrder", "=", "trx_po_detail.id_PurchaseOrder");
                })
                ->select('trx_po_detail.*')
                ->where('trx_po_detail.id_purchaseorder', $id_PurchaseOrder)
                ->where('trx_po_detail.keterangan', 'ItemPO')
                ->get();
        return view('Goods Receipt.GR DF.v_gr_adddf',$data,compact('item','purchase','supplier','kd','gudang'));
    }

    public function GrDFsubmitData(Request $request)
    {
    //     Request()->validate([
    //         'kode_gudang' => 'required|unique:trx_stok,barcode',
    //         'jumlah' => 'required|numeric'
    //     ],[
    //         'kode_gudang.unique' => 'Barcode ini sudah ada',
    //         'jumlah.required' => 'Wajib Diisi !',
    //         'jumlah.numeric' => 'Wajib Diisi Angka !',
    //     ]
    // );
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'TAMBAH',
            'status' => 'ACTIVE',
            'id_purchaseorder' => Request()->id_PurchaseOrder,
            'Tanggal' => Request()->tanggal,
            'id_supp' => Request()->id_supplier,
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
            'id_user' => Request()->id_user
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $jumlah = $request->jumlah[$key];
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->kode_gudang[$key];
            $datas->keterangan = $request->keterangan[$key];
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->save();
            LineItemPOModel::where('id_barang', $request-> id_barang[$key])
                                    ->where('id_purchaseorder', $request->id_PurchaseOrder)
                                    ->where('trx_po_detail.keterangan', 'ItemPO')
                                    ->update(["sisa" => DB::raw("sisa - '$jumlah'")]);
        }
        $bulan = date('m');
        $year = date('Y');
        DB::select('CALL HITUNGAWAL1("'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","FG1")');
        DB::select('CALL HITUNG1("R%","'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","FG1")');
        DB::select('CALL HITUNGSALDO("'.$year.'","'.$bulan.'","FG1")');

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
            $gipenjualan=TransaksiGudangModel::where("trx_gudang.ID_Transaksi", "like", "jf%")
                ->where("trx_gudang.customer", "LIKE", '%'.$customer.'%')
                ->where("trx_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("trx_gudang.id_sales", "like", '%'.$id_sales.'%')
                ->where("trx_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
            
        }else{
            $gipenjualan=TransaksiGudangModel::where("trx_gudang.ID_Transaksi", "like", "jf%")
                ->orderBy("trx_gudang.ID_Transaksi","desc")
                ->get();
        }
        return view('Goods Issue.GI Penjualan.v_gi_penjualan',compact('gipenjualan'));
    }

    public function addgipenjualan(Request $request)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $q = DB::table('trx_gudang')
                ->select(DB::raw('MAX(RIGHT(ID_Transaksi,3)) as kode'))
                ->where("ID_Transaksi", "like", "jf%")
                ->whereMonth('Tanggal', $bulan)
                ->whereYear('Tanggal', $tahun);
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
        return view('Goods Issue.GI Penjualan.v_gi_addpenjualan',compact('supplier','kd'));
    }

    public function ajax4(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_barang = TStokModel::where('barcode', $kode_barang)->get();

        return view('Goods Issue.GI Penjualan.ajax', compact('ajax_barang'));
    }

    public function ajax5(Request $request)
    {
        $kode_barang['barcode'] = $request->kode_barang;
        $ajax_barang = TStokModel::where('barcode', $kode_barang)->get();

        return view('Goods Issue.GI Penjualan.ajax_panjang', compact('ajax_barang'));
    }

    public function GiPenjualansubmitData(Request $request)
    {
        $data = [
            'ID_Transaksi' => Request()->id_Transaksi,
            'TRANSAKSI' => 'KURANG',
            'id_sales' => Request()->id_sales,
            'Tanggal' => Request()->tanggal,
            'customer' => Request()->customer,
            'no_tlp_cust' => Request()->no_tlp_cust,
            'alamat_cust' => Request()->alamat_cust,
            'status' => 'ACTIVE',
            'total_panjang' => Request()->total_panjang,
            'total_roll' => Request()->total_roll,
            'id_user' => Request()->id_user
        ];
        $this->TransaksiGudangModel->addData($data);
        foreach($request->kode_barang as $key=>$kode_barang){
            $kode = [$request->kode_barang[$key]];
            
            $datas = new TranDetailModel();
            $datas->barcode =$kode_barang;
            $datas->id_barang = $request->id_barang[$key];
            $datas->jumlah = $request->jumlah[$key];
            $datas->id_lokasi = $request->id_lokasi[$key];
            $datas->keterangan = $request->keterangan[$key];
            $datas->ID_TRAN = $request->id_Transaksi;
            $datas->save();
            //line_item_barang_Model::whereIn('kode_barang', $kode)->update(["ID_GI" => $request->id_Transaksi]);
        }
        $bulan = date('m');
        $year = date('Y');
        DB::select('CALL HITUNGAWAL1("'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","FG1")');
        DB::select('CALL HITUNG1("JF%","'.$year.'-'.$bulan.'-01","'.$year.'-'.$bulan.'-31","FG1")');
        DB::select('CALL HITUNGSALDO("'.$year.'","'.$bulan.'","FG1")');

        
        return redirect('/gipenjualan')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailgipenjualan($ID_Transaksi){
        
        $gipenjualan=TransaksiGudangModel::where("ID_Transaksi", "=", $ID_Transaksi)
                        ->first();
        $data = [
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        
        return view('Goods Issue.GI Penjualan.v_gi_detailpenjualan', compact('gipenjualan'), $data);
    }

    public function editgipenjualan($ID_Transaksi)
    {
        $gipenjualan=TransaksiGudangModel::where("ID_Transaksi", "=", $ID_Transaksi)
                        ->first();
        $data = [
            'item' =>$this->TransaksiGudangModel->GIItemdetailData($ID_Transaksi),
        ];
        
        return view('Goods Issue.GI Penjualan.v_gi_editpenjualan', compact('gipenjualan'), $data);
    }

    public function updategipenjualan( $ID_Transaksi)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->TransaksiGudangModel->editData($ID_Transaksi,$data);
        

        return redirect('/gipenjualan')->with('pesan','Data berhasil diupdate');
    }

    public function printsj($ID_Transaksi){

        $gipenjualan=TransaksiGudangModel::where("ID_Transaksi", "=", $ID_Transaksi)
                        ->first();
        $item=DB::table("trx_gudang_detail")
                ->join("barang", function($join){
                    $join->on("barang.id_barang", "=", "trx_gudang_detail.id_barang");
                })
                ->select("trx_gudang_detail.id_barang", "barang.keterangan1", "barang.keterangan2", DB::raw("(sum(jumlah)) as total_panjang"),DB::raw("count(barcode) as total_roll"))
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->groupBy("trx_gudang_detail.id_barang")
                ->get();
        // dd($item);
        return view('Goods Issue.GI Penjualan.v_printsj', compact('gipenjualan','item'));
    }

    public function printpl(Request $request, $ID_Transaksi){
        $totalItem = DB::table("trx_gudang_detail")
                ->join("barang", function($join){
                            $join->on("barang.id_barang", "=", "trx_gudang_detail.id_barang");
                        })
                ->join("trx_gudang", function($join){
                    $join->on("trx_gudang.id_transaksi", "=", "trx_gudang_detail.ID_TRAN");
                })
                ->select("trx_gudang.*", "trx_gudang_detail.id_barang","barang.*",DB::raw("(sum(trx_gudang_detail.jumlah)) as total_panjang"),DB::raw("count(trx_gudang_detail.barcode) as total_roll"))
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->groupBy("trx_gudang_detail.id_barang")
                ->get();
        $a = DB::table("trx_gudang_detail")
                ->select("id_barang","jumlah")
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->get();
                    
        
        return view('Goods Issue.GI Penjualan.v_printpl', compact('a','totalItem'));
       
    }

    public function printsjdf($ID_Transaksi){

        $data = [
            'gidf' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
        ];
        $item=DB::table("trx_gudang_detail")
                ->join("barang", function($join){
                    $join->on("barang.id_barang", "=", "trx_gudang_detail.id_barang");
                })
                ->join("satuan", function($join){
                    $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->select("satuan","trx_gudang_detail.id_barang", "barang.keterangan1", "barang.keterangan2", DB::raw("(sum(jumlah)) as total_panjang"),DB::raw("count(barcode) as total_roll"))
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->groupBy("trx_gudang_detail.id_barang")
                ->get();
        // dd($item);
        return view('Goods Issue.GI DF.v_printsjdf', compact('item'),$data);
    }

    public function printpldf(Request $request, $ID_Transaksi){
        $totalItem = DB::table("trx_gudang_detail")
                ->join("barang", function($join){
                            $join->on("barang.id_barang", "=", "trx_gudang_detail.id_barang");
                        })
                ->join("trx_gudang", function($join){
                    $join->on("trx_gudang.id_transaksi", "=", "trx_gudang_detail.ID_TRAN");
                })
                ->join("supplier", function($join){
                    $join->on("trx_gudang.id_supp", "=", "supplier.id_supp");
                })
                ->join("regencies", function($join){
                    $join->on("supplier.regencies_id", "=", "regencies.id");
                })
                ->select("regencies.*","supplier.*","trx_gudang.*", "trx_gudang_detail.id_barang","barang.*",DB::raw("(sum(trx_gudang_detail.jumlah)) as total_panjang"),DB::raw("count(trx_gudang_detail.barcode) as total_roll"))
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->groupBy("trx_gudang_detail.id_barang")
                ->get();
        $a = DB::table("trx_gudang_detail")
                ->select("id_barang","jumlah")
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->get();
                    
        
        return view('Goods Issue.GI DF.v_printpldf', compact('a','totalItem'));
       
    }

    public function printsjtw($ID_Transaksi){

        $data = [
            'gitwisting' =>$this->TransaksiGudangModel->detailData($ID_Transaksi),
        ];
        $item=DB::table("trx_gudang_detail")
                ->join("barang", function($join){
                    $join->on("barang.id_barang", "=", "trx_gudang_detail.id_barang");
                })
                ->join("satuan", function($join){
                    $join->on("barang.id_satuan", "=", "satuan.id_satuan");
                })
                ->select("satuan","trx_gudang_detail.id_barang", "barang.keterangan1", "barang.keterangan2", DB::raw("(sum(jumlah)) as total_panjang"),DB::raw("count(barcode) as total_roll"))
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->groupBy("trx_gudang_detail.id_barang")
                ->get();
        // dd($item);
        return view('Goods Issue.GI twisting.v_printsjtw', compact('item'),$data);
    }

    public function printpltw(Request $request, $ID_Transaksi){
        $totalItem = DB::table("trx_gudang_detail")
                ->join("barang", function($join){
                            $join->on("barang.id_barang", "=", "trx_gudang_detail.id_barang");
                        })
                ->join("trx_gudang", function($join){
                    $join->on("trx_gudang.id_transaksi", "=", "trx_gudang_detail.ID_TRAN");
                })
                ->join("supplier", function($join){
                    $join->on("trx_gudang.id_supp", "=", "supplier.id_supp");
                })
                ->join("regencies", function($join){
                    $join->on("supplier.regencies_id", "=", "regencies.id");
                })
                ->select("regencies.*","supplier.*","trx_gudang.*", "trx_gudang_detail.id_barang","barang.*",DB::raw("(sum(trx_gudang_detail.jumlah)) as total_panjang"),DB::raw("count(trx_gudang_detail.barcode) as total_roll"))
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->groupBy("trx_gudang_detail.id_barang")
                ->get();
        $a = DB::table("trx_gudang_detail")
                ->select("id_barang","jumlah")
                ->where('trx_gudang_detail.ID_TRAN', $ID_Transaksi)
                ->get();
                    
        
        return view('Goods Issue.GI twisting.v_printpltw', compact('a','totalItem'));
       
    }
}