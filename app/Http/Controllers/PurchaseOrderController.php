<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;
use App\Models\LineItemPOModel;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->PurchaseOrderModel = new PurchaseOrderModel();
        // $this->middleware('auth');
    }

    public function indexpobenang()
    {
        $data = [
            'pobenang'=> $this->PurchaseOrderModel->allData(),
        ];
        return view('Purchase Order.PO benang.v_po_benang',$data);
    }

    public function addpobenang()
    {
        $supplier = SupplierModel::all();
        $data = [
            'benang'=> $this->PurchaseOrderModel->BenangallData(),
        ];
        return view('Purchase Order.PO benang.v_addpobenang',$data,compact('supplier'));
    }

    public function submitData(Request $request)
    {
        $data = [
            'id_PurchaseOrder' => Request()->id_PurchaseOrder,
            'tanggal' => Request()->tanggal,
            'id_supplier' => Request()->id_supplier,
            'total_harga' => Request()->total_harga,
            'status' => Request()->status,
            'jenis_bayar' => Request()->jenis_bayar,
        ];
        $this->PurchaseOrderModel->BenangaddData($data);
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
}
