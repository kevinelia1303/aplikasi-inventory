<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\JenisBarangModel;
use App\Models\SatuanModel;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        // $this->middleware('auth');
    }

    public function indexfg()
    {

        $data = [
            'finished_goods'=> $this->BarangModel->FGallData(),
        ];
        return view('master.finished goods.v_fg',$data);
    }

    public function addfg()
    {
        $jenis_barang = JenisBarangModel::all();
        $satuan = SatuanModel::all();
        return view('master.finished goods.v_addfg', compact('jenis_barang','satuan'));
    }

    public function insertfg(Request $request)
    {
        // Request()->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email',
        //     'password' => 'required',
        //     'jabatan' => 'required',
        //     'divisi' => 'required',

        // ],[
        //     'name.required' => 'wajib diisi',
        // ]);

        BarangModel::create([
            'id_barang' => $request->id_barang,
            'keterangan1' => $request->keterangan1,
            'keterangan2' => $request->keterangan2,
            'keterangan3' => $request->keterangan3,
            'id_jenis_barang' => $request->id_jenis_barang,
            'id_satuan' => $request->id_satuan
        ]);

        return redirect('/finished-goods')->with('pesan', 'Data Berhasil Disimpan');
    }
    public function detailfg($id_barang){
        $data = [
            'finished_goods' =>$this->BarangModel->FGdetailData($id_barang),
        ];
        
        return view('master.finished goods.v_detailfg', $data);
    }

    public function editfg($id_barang)
    {
        $jenis_barang = JenisBarangModel::all();
        $satuan = SatuanModel::all();
        $data = [
            'finished_goods' =>$this->BarangModel->FGdetailData($id_barang),
        ];
        
        return view('master.finished goods.v_editfg', $data, compact('jenis_barang','satuan'));
    }

    public function updatefg(Request $request, $id_barang)
    {
        $data = [
            'id_barang' => $request->id_barang,
            'keterangan1' => $request->keterangan1,
            'keterangan2' => $request->keterangan2,
            'keterangan3' => $request->keterangan3,
            'id_jenis_barang' => $request->id_jenis_barang,
            'id_satuan' => $request->id_satuan
        ];
        $this->BarangModel->FGeditData($id_barang,$data);
        

        return redirect('/finished-goods')->with('pesan','Data berhasil diupdate');
    }

    public function deletefg($id_barang)
    {
       $this->BarangModel->FGdeleteData($id_barang);
       return redirect('/finished-goods')->with('pesan','Data berhasil dihapus');
    }

    public function indexgreige()
    {

        $data = [
            'greige'=> $this->BarangModel->GreigeallData(),
        ];
        return view('master.greige.v_greige',$data);
    }

    public function addgreige()
    {
        $jenis_barang = JenisBarangModel::all();
        $satuan = SatuanModel::all();
        return view('master.greige.v_addgreige', compact('jenis_barang','satuan'));
    }

    public function insertgreige(Request $request)
    {
        // Request()->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email',
        //     'password' => 'required',
        //     'jabatan' => 'required',
        //     'divisi' => 'required',

        // ],[
        //     'name.required' => 'wajib diisi',
        // ]);

        BarangModel::create([
            'id_barang' => $request->id_barang,
            'keterangan1' => $request->keterangan1,
            'keterangan2' => $request->keterangan2,
            'keterangan3' => $request->keterangan3,
            'keterangan4' => $request->keterangan4,
            'id_jenis_barang' => $request->id_jenis_barang,
            'id_satuan' => $request->id_satuan
        ]);

        return redirect('/greige')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function editgreige($id_barang)
    {
        $jenis_barang = JenisBarangModel::all();
        $satuan = SatuanModel::all();
        $data = [
            'greige' =>$this->BarangModel->GreigedetailData($id_barang),
        ];
        
        return view('master.greige.v_editgreige', $data, compact('jenis_barang','satuan'));
    }

    public function updategreige(Request $request, $id_barang)
    {
        $data = [
            'id_barang' => $request->id_barang,
            'keterangan1' => $request->keterangan1,
            'keterangan2' => $request->keterangan2,
            'keterangan3' => $request->keterangan3,
            'keterangan4' => $request->keterangan4,
            'id_jenis_barang' => $request->id_jenis_barang,
            'id_satuan' => $request->id_satuan
        ];
        $this->BarangModel->GreigeeditData($id_barang,$data);
        

        return redirect('/greige')->with('pesan','Data berhasil diupdate');
    }

    public function deletegreige($id_barang)
    {
       $this->BarangModel->GreigedeleteData($id_barang);
       return redirect('/greige')->with('pesan','Data berhasil dihapus');
    }

    public function detailgreige($id_barang){
        $data = [
            'greige' =>$this->BarangModel->FGdetailData($id_barang),
        ];
        
        return view('master.greige.v_detailgreige', $data);
    }

    public function indexbenang()
    {

        $data = [
            'benang'=> $this->BarangModel->BenangallData(),
        ];
        return view('master.benang.v_benang',$data);
    }

    public function addbenang()
    {
        $jenis_barang = JenisBarangModel::all();
        $satuan = SatuanModel::all();
        return view('master.benang.v_addbenang', compact('jenis_barang','satuan'));
    }

    public function insertbenang(Request $request)
    {
        // Request()->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email',
        //     'password' => 'required',
        //     'jabatan' => 'required',
        //     'divisi' => 'required',

        // ],[
        //     'name.required' => 'wajib diisi',
        // ]);

        BarangModel::create([
            'id_barang' => $request->id_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'id_satuan' => $request->id_satuan
        ]);

        return redirect('/benang')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function editbenang($id_barang)
    {
        $jenis_barang = JenisBarangModel::all();
        $satuan = SatuanModel::all();
        $data = [
            'benang' =>$this->BarangModel->BenangdetailData($id_barang),
        ];
        
         return view('master.benang.v_editbenang', $data, compact('jenis_barang','satuan'));
    }

    public function updatebenang(Request $request, $id_barang)
    {
        $data = [
            'id_barang' => $request->id_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'id_satuan' => $request->id_satuan
        ];
        $this->BarangModel->BenangeditData($id_barang,$data);
        

        return redirect('/benang')->with('pesan','Data berhasil diupdate');
    }

    public function deletebenang($id_barang)
    {
       $this->BarangModel->BenangdeleteData($id_barang);
       return redirect('/benang')->with('pesan','Data berhasil dihapus');
    }

    public function detailbenang($id_barang){
        $data = [
            'benang' =>$this->BarangModel->BenangdetailData($id_barang),
        ];
        
        return view('master.benang.v_detailbenang', $data);
    }
}
