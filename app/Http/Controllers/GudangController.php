<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GudangModel;
use App\Models\RegencyModel;
use App\Models\ProvincesModel;

class GudangController extends Controller
{
    public function __construct()
    {
        $this->GudangModel = new GudangModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'gudang'=> $this->GudangModel->allData(),
        ];
        return view('master.gudang.v_gudang',$data);
    }

    public function add()
    {
        $provinsi = ProvincesModel::all();
        $kota = RegencyModel::all();
        return view('master.gudang.v_addgudang', compact('provinsi','kota'));
    }

    public function edit($id)
    {
        if (!$this->GudangModel->detailData($id)) {
           abort(404);
        }
        $data = [
            'gudang' =>$this->GudangModel->detailData($id),
        ];
        $provinsi = ProvincesModel::all();
        $kota = RegencyModel::all();
        
        return view('master.gudang.v_editgudang', $data, compact('kota','provinsi'));
    }

    public function insert()
    {
        // Request()->validate([
        //     'kode_gudang' => 'required|unique:gudang,kode_gudang',
        //     'nama_gudang' => 'required',
        //     'alamat' => 'required',
        //     'kota' => 'required',

        // ],[
        //     'kode_gudang.required' => 'wajib diisi',
        // ]);

        $data = [
            'kode_gudang' => Request()->kode_gudang,
            'nama_gudang' => Request()->nama_gudang,
            'alamat' => Request()->alamat,
            'regencies_id' => Request()->kota,
            'province_id' => Request()->provinsi,
        ];
        $this->GudangModel->addData($data);

        return redirect('/gudang')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $kode_gudang)
    {
       

        $data = [
            'kode_gudang' => Request()->kode_gudang,
            'nama_gudang' => Request()->nama_gudang,
            'alamat' => Request()->alamat,
            'regencies_id' => Request()->kota,
            'province_id' => Request()->provinsi,
        ];
        $this->GudangModel->editData($kode_gudang,$data);
        

        return redirect('/gudang')->with('pesan','Data berhasil diupdate');
    }

    public function delete($kode_gudang)
    {
       $this->GudangModel->deleteData($kode_gudang);
       return redirect('/gudang')->with('pesan','Data berhasil dihapus');
    }


}
