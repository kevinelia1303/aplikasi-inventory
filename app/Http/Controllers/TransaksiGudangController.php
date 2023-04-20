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
        $supplier1 = SupplierModel::all();
        //filter by id
        if($ID_Transaksi OR $tanggal OR $supplier <> ""){
            $grbenang=TransaksiGudangModel::join('supplier', 'transaksi_gudang.ID_Transaksi','=','supplier.id_supp')
                ->where("transaksi_gudang.id_supplier", "LIKE", $supplier)
                ->where("transaksi_gudang.ID_Transaksi", "like", '%'.$ID_Transaksi.'%')
                ->where("transaksi_gudang.tanggal", "LIKE", $tanggal)
                ->orderBy("purchase_order.ID_Transaksi","asc")
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
}
