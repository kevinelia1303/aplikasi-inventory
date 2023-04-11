<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;

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
}
