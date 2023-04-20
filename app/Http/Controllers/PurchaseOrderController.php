<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;
use App\Models\LineItemPOModel;
use App\Models\ListKebutuhanMaklonModel;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->PurchaseOrderModel = new PurchaseOrderModel();
        // $this->middleware('auth');
    }

    public function indexpobenang(Request $request)
    {
        
        // return $request->all();
        $id_purchaseorder=$request->id_PurchaseOrder;
        $tanggal=$request->tanggal;
        $status=$request->status;
        
        //filter by id
        if($id_purchaseorder OR $tanggal OR $status <> ""){
            $pobenang=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.status", "LIKE", $status)
                ->where("purchase_order.id_purchaseorder", "like", '%'.$id_purchaseorder.'%')
                ->where("purchase_order.tanggal", "LIKE", $tanggal)
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
            
        }else{
            $pobenang=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.id_purchaseorder", "like", "py%")
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
        }
        return view('Purchase Order.PO benang.v_po_benang',compact('pobenang'));
    }

    public function addpobenang()
    {
        $supplier = SupplierModel::all();
        $data = [
            'benang'=> $this->PurchaseOrderModel->BenangallData(),
        ];
        return view('Purchase Order.PO benang.v_addpobenang',$data,compact('supplier'));
    }

    public function BenangsubmitData(Request $request)
    {
        $data = [
            'id_PurchaseOrder' => Request()->id_PurchaseOrder,
            'tanggal' => Request()->tanggal,
            'id_supplier' => Request()->id_supplier,
            'total_harga' => Request()->total_harga,
            'status' => Request()->status,
            'jenis_bayar' => Request()->jenis_bayar,
        ];
        $this->PurchaseOrderModel->addData($data);
        foreach($request->id_barang as $key=>$id_barang){
            $datas = new LineItemPOModel();
            $datas->id_barang =$id_barang;
            $datas->jumlah = $request->jumlah[$key];
            $datas->harga = $request->harga[$key];
            $datas->TotalHarga = $request->total[$key];
            $datas->id_PurchaseOrder = $request->id_PurchaseOrder;
            $datas->save();
        }
        return redirect('/pobenang')->with('pesan', 'Data Berhasil Disimpan');
    }
    public function detailpobenang($id_PurchaseOrder){
        $data = [
            'pobenang' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
        ];
        $item = [
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
        ];
         
        return view('Purchase Order.PO benang.v_detailpobenang', $data, $item);
    }

    public function editpo($id_PurchaseOrder)
    {
        $data = [
            'po' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
        ];
        $item = [
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
        ];
        $supplier = SupplierModel::all();
        
        return view('Purchase Order.PO benang.v_editpobenang', $data,$item,$supplier);
    }

    public function updatepo( $id_PurchaseOrder)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->PurchaseOrderModel->editData($id_PurchaseOrder,$data);
        

        return redirect('/pobenang')->with('pesan','Data berhasil diupdate');
    }

    public function indexpogreige(Request $request)
    {
        
        // return $request->all();
        $id_purchaseorder=$request->id_PurchaseOrder;
        $tanggal=$request->tanggal;
        $status=$request->status;
        
        //filter by id
        if($id_purchaseorder OR $tanggal OR $status <> ""){
            $pogreige=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.status", "LIKE", $status)
                ->where("purchase_order.id_purchaseorder", "like", '%'.$id_purchaseorder.'%')
                ->where("purchase_order.tanggal", "LIKE", $tanggal)
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
            
        }else{
            $pogreige=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.id_purchaseorder", "like", "pg%")
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
        }
        return view('Purchase Order.PO Greige.v_po_greige',compact('pogreige'));
    }

    public function addpogreige()
    {
        $supplier = SupplierModel::all();
        $data = [
            'greige'=> $this->PurchaseOrderModel->GreigeallData(),
        ];
        return view('Purchase Order.PO Greige.v_addpogreige',$data,compact('supplier'));
    }

    public function GreigesubmitData(Request $request)
    {
        $data = [
            'id_PurchaseOrder' => Request()->id_PurchaseOrder,
            'tanggal' => Request()->tanggal,
            'id_supplier' => Request()->id_supplier,
            'total_harga' => Request()->total_harga,
            'status' => Request()->status,
            'jenis_bayar' => Request()->jenis_bayar,
        ];
        $this->PurchaseOrderModel->addData($data);
        foreach($request->id_barang as $key=>$id_barang){
            $datas = new LineItemPOModel();
            $datas->id_barang =$id_barang;
            $datas->jumlah = $request->jumlah[$key];
            $datas->harga = $request->harga[$key];
            $datas->TotalHarga = $request->total[$key];
            $datas->id_PurchaseOrder = $request->id_PurchaseOrder;
            $datas->save();
        }
        return redirect('/pogreige')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailpogreige($id_PurchaseOrder){
        $data = [
            'pogreige' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
        ];
        $item = [
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
        ];
         
        return view('Purchase Order.PO Greige.v_detailpogreige', $data, $item);
    }

    public function editpogreige($id_PurchaseOrder)
    {
        $data = [
            'pogreige' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
        ];
        $item = [
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
        ];
        $supplier = SupplierModel::all();
        
        return view('Purchase Order.PO Greige.v_editpogreige', $data,$item,$supplier);
    }

    public function updatepogreige( $id_PurchaseOrder)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->PurchaseOrderModel->editData($id_PurchaseOrder,$data);
        

        return redirect('/pogreige')->with('pesan','Data berhasil diupdate');
    }

    public function indexpotwisting(Request $request)
    {
        
        // return $request->all();
        $id_purchaseorder=$request->id_PurchaseOrder;
        $tanggal=$request->tanggal;
        $status=$request->status;
        
        //filter by id
        if($id_purchaseorder OR $tanggal OR $status <> ""){
            $potwisting=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.status", "LIKE", $status)
                ->where("purchase_order.id_purchaseorder", "like", '%'.$id_purchaseorder.'%')
                ->where("purchase_order.tanggal", "LIKE", $tanggal)
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
            
        }else{
            $potwisting=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.id_purchaseorder", "like", "MR%")
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
        }
        return view('Purchase Order.PO Twisting.v_po_maklontwisting',compact('potwisting'));
    }

    public function addpotwisting()
    {
        $supplier = SupplierModel::all();
        $data = [
            'greige'=> $this->PurchaseOrderModel->GreigeallData(),
            'benang'=> $this->PurchaseOrderModel->BenangallData(),
        ];
        return view('Purchase Order.PO Twisting.v_po_addtwisting',compact('supplier'),$data);
    }

    public function TwistingsubmitData(Request $request)
    {
        $data = [
            'id_PurchaseOrder' => Request()->id_PurchaseOrder,
            'tanggal' => Request()->tanggal,
            'id_supplier' => Request()->id_supplier,
            'total_harga' => Request()->total_harga,
            'status' => Request()->status,
            'jenis_bayar' => Request()->jenis_bayar,
        ];
        $this->PurchaseOrderModel->addData($data);
        foreach($request->id_barang as $key=>$id_barang){
            $datas = new LineItemPOModel();
            $datas->id_barang =$id_barang;
            $datas->jumlah = $request->jumlah[$key];
            $datas->harga = $request->harga[$key];
            $datas->TotalHarga = $request->total[$key];
            $datas->id_PurchaseOrder = $request->id_PurchaseOrder;
            $datas->save();
        }
        foreach($request->id_barangmaklon as $key=>$id_barangmaklon){
            $datas = new ListKebutuhanMaklonModel();
            $datas->id_barang =$id_barangmaklon;
            $datas->jumlah = $request->total_maklon[$key];
            $datas->id_PurchaseOrder = $request->id_PurchaseOrder;
            $datas->sisa = $request->total_maklon[$key];
            $datas->save();
        }
        return redirect('/pomaklontwisting')->with('pesan', 'Data Berhasil Disimpan');
    }
    public function detailpotwisting($id_PurchaseOrder){
        $data = [
            'potwisting' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
            'list_kebutuhan'=>$this->PurchaseOrderModel->ItemMaklondetailData($id_PurchaseOrder),
        ];
        
         
        return view('Purchase Order.PO Twisting.v_po_detailtwisting', $data);
    }

    public function editpotwisting($id_PurchaseOrder)
    {
        $data = [
            'potwisting' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
            'list_kebutuhan'=>$this->PurchaseOrderModel->ItemMaklondetailData($id_PurchaseOrder),
        ];
        
        return view('Purchase Order.PO Twisting.v_po_edittwisting', $data);
    }

    public function updatepotwisting( $id_PurchaseOrder)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->PurchaseOrderModel->editData($id_PurchaseOrder,$data);
        

        return redirect('/pomaklontwisting')->with('pesan','Data berhasil diupdate');
    }

    public function indexpodf(Request $request)
    {
        
        // return $request->all();
        $id_purchaseorder=$request->id_PurchaseOrder;
        $tanggal=$request->tanggal;
        $status=$request->status;
        
        //filter by id
        if($id_purchaseorder OR $tanggal OR $status <> ""){
            $podf=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.status", "LIKE", $status)
                ->where("purchase_order.id_purchaseorder", "like", '%'.$id_purchaseorder.'%')
                ->where("purchase_order.tanggal", "LIKE", $tanggal)
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
            
        }else{
            $podf=PurchaseOrderModel::join('supplier', 'purchase_order.id_supplier','=','supplier.id_supp')
                ->where("purchase_order.id_purchaseorder", "like", "MF%")
                ->orderBy("purchase_order.id_purchaseorder","asc")
                ->get();
        }
        return view('Purchase Order.PO DF.v_po_maklondf',compact('podf'));
    }

    public function addpodf()
    {
        $supplier = SupplierModel::all();
        $data = [
            'greige'=> $this->PurchaseOrderModel->GreigeallData(),
            'fg'=> $this->PurchaseOrderModel->FGallData(),
        ];
        return view('Purchase Order.PO DF.v_po_adddf',compact('supplier'),$data);
    }

    public function DFsubmitData(Request $request)
    {
        $data = [
            'id_PurchaseOrder' => Request()->id_PurchaseOrder,
            'tanggal' => Request()->tanggal,
            'id_supplier' => Request()->id_supplier,
            'total_harga' => Request()->total_harga,
            'status' => Request()->status,
            'jenis_bayar' => Request()->jenis_bayar,
        ];
        $this->PurchaseOrderModel->addData($data);
        foreach($request->id_barang as $key=>$id_barang){
            $datas = new LineItemPOModel();
            $datas->id_barang =$id_barang;
            $datas->jumlah = $request->jumlah[$key];
            $datas->harga = $request->harga[$key];
            $datas->TotalHarga = $request->total[$key];
            $datas->id_PurchaseOrder = $request->id_PurchaseOrder;
            $datas->save();
        }
        foreach($request->id_barangmaklon as $key=>$id_barangmaklon){
            $datas = new ListKebutuhanMaklonModel();
            $datas->id_barang =$id_barangmaklon;
            $datas->jumlah = $request->total_maklon[$key];
            $datas->id_PurchaseOrder = $request->id_PurchaseOrder;
            $datas->sisa = $request->total_maklon[$key];
            $datas->save();
        }
        return redirect('/pomaklondf')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function detailpodf($id_PurchaseOrder){
        $data = [
            'podf' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
            'list_kebutuhan'=>$this->PurchaseOrderModel->ItemMaklondetailData($id_PurchaseOrder),
        ];
        
         
        return view('Purchase Order.PO DF.v_po_detaildf', $data);
    }

    public function editpodf($id_PurchaseOrder)
    {
        $data = [
            'podf' =>$this->PurchaseOrderModel->detailData($id_PurchaseOrder),
            'item' =>$this->PurchaseOrderModel->ItemdetailData($id_PurchaseOrder),
            'list_kebutuhan'=>$this->PurchaseOrderModel->ItemMaklondetailData($id_PurchaseOrder),
        ];
        
        return view('Purchase Order.PO DF.v_po_editdf', $data);
    }

    public function updatepodf( $id_PurchaseOrder)
    {
        $data = [
            'status' => Request()->status,
        ];
        $this->PurchaseOrderModel->editData($id_PurchaseOrder,$data);
        

        return redirect('/pomaklondf')->with('pesan','Data berhasil diupdate');
    }
}
