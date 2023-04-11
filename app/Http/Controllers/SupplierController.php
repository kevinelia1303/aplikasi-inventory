<?php

namespace App\Http\Controllers;

use App\Models\ProvincesModel;
use App\Models\RegencyModel;
use App\Models\SupplierModel;


use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->SupplierModel = new SupplierModel();
        // $this->middleware('auth');
    }

    public function index()
    {
        $supplier = SupplierModel::all();
        $data = [
            'supp'=> $this->SupplierModel->allData(),
        ];
        return view('master.supplier.v_supplier',$data, compact('supplier'));
    }

    public function add()
    {
        // $kota = KotaModel::all();
        $provinsi = ProvincesModel::all();
        $kota = RegencyModel::all();
        return view('master.supplier.v_addsupplier', compact('provinsi','kota'));
    }

    public function insert()
    {
        SupplierModel::create([
            'nama_supplier' => Request()->nama_supplier,
            'alamat' => Request()->alamat,
            'no_telepon' => Request()->no_telepon,
            'contact_person' => Request()->contact_person,
            'regencies_id' => Request()->kota,
            'province_id' => Request()->provinsi,
        ]);

        return redirect('/supplier')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        if (!$this->SupplierModel->detailData($id)) {
           abort(404);
        }
        $data = [
            'supplier' =>$this->SupplierModel->detailData($id),
        ];
        $provinsi = ProvincesModel::all();
        $kota = RegencyModel::all();
        return view('master.supplier.v_editsupplier',$data, compact('kota','provinsi'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama_supplier' => Request()->nama_supplier,
            'alamat' => Request()->alamat,
            'no_telepon' => Request()->no_telepon,
            'contact_person' => Request()->contact_person,
            'regencies_id' => Request()->kota,
            'province_id' => Request()->provinsi,
        ];
        $this->SupplierModel->editData($id,$data);
        

        return redirect('/supplier')->with('pesan','Data berhasil diupdate');
    }

    public function delete($id)
    {
       $this->SupplierModel->deleteData($id);
       return redirect('/supplier')->with('pesan','Data berhasil dihapus');
    }
}
