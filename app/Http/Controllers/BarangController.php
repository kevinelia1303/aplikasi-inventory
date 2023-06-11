<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\JenisBarangModel;
use App\Models\line_item_barang_Model;
use App\Models\SatuanModel;
use App\Models\TStokModel;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        $this->middleware('auth');
    }

    public function indexfg(Request $request)
    {
        $id_barang=$request->id_barang;
        $nama=$request->nama;
        $warna=$request->warna;
        if ($id_barang OR $nama OR $warna <> "") {
            $finished_goods=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("jenis_barang","jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("barang.keterangan1","like",'%'.$nama.'%')
                                ->where("barang.keterangan2","like",'%'.$warna.'%')
                                ->where("barang.id_jenis_barang",1)
                                ->orderBy("barang.keterangan1","asc")
                                ->orderBy("barang.keterangan2","asc")
                                ->orderBy("barang.keterangan3","asc")
                                ->get();
        }else{
            $finished_goods=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("jenis_barang","jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang")
                                ->where("barang.id_barang","like",'F%')
                                ->orderBy("barang.keterangan1","asc")
                                ->orderBy("barang.keterangan2","asc")
                                ->orderBy("barang.keterangan3","asc")
                                ->get();
        }
        $data = [
            'finished_goods'=> $this->BarangModel->FGallData(),
        ];
        return view('master.finished goods.v_fg',compact('finished_goods'));
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
            'list' =>$this->BarangModel->listItem($id_barang)
        ];
        $total_roll = TStokModel::where('id_barang',$id_barang)
                        ->where("trx_stok.jumlah", ">",0)
                        ->count('id_barang');
        $total_panjang = TStokModel::where('id_barang',$id_barang)
                        ->where("trx_stok.jumlah", ">",0)
                        ->sum('trx_stok.jumlah');
        
        return view('master.finished goods.v_detailfg', compact('total_roll','total_panjang'), $data);
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

    public function indexgreige(Request $request)
    {
        $id_barang=$request->id_barang;
        if ($id_barang <> "") {
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("jenis_barang","jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("barang.id_jenis_barang",2)
                                ->orderBy("barang.id_barang","asc")
                                ->get();
        }else{
            $greige=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("jenis_barang","jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang")
                                ->where("barang.id_barang","like",'ITJ%')
                                ->orderBy("barang.id_barang","asc")
                                ->get();
        }
        return view('master.greige.v_greige', compact('greige'));
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
            'greige' =>$this->BarangModel->GreigedetailData($id_barang),
            'list' =>$this->BarangModel->listItem($id_barang)
        ];
        $total_roll = TStokModel::where('id_barang',$id_barang)
                        ->where("trx_stok.jumlah", ">",0)
                        ->count('id_barang');
        $total_panjang = TStokModel::where('id_barang',$id_barang)
                        ->where("trx_stok.jumlah", ">",0)
                        ->sum('trx_stok.jumlah');
        
        return view('master.greige.v_detailgreige', compact('total_roll','total_panjang'), $data);
    }

    public function indexbenang(Request $request)
    {
        $id_barang=$request->id_barang;
        if ($id_barang <> "") {
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("jenis_barang","jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang")
                                ->where("barang.id_barang","like",'%'.$id_barang.'%')
                                ->where("barang.id_jenis_barang",3)
                                ->get();
        }else{
            $benang=BarangModel::join('satuan', "barang.id_satuan", "=", "satuan.id_satuan")
                                ->join("jenis_barang","jenis_barang.id_jenis_barang", "=", "barang.id_jenis_barang")
                                ->where("barang.id_barang","like",'YA%')
                                ->get();
        }
        
        return view('master.benang.v_benang', compact('benang'));
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
            'id_satuan' => $request->id_satuan,
            'keterangan1' => $request->keterangan1,
            'keterangan2' => $request->keterangan2,
            'keterangan3' => $request->keterangan3,
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
            'id_satuan' => $request->id_satuan,
            'keterangan1' => $request->keterangan1,
            'keterangan2' => $request->keterangan2,
            'keterangan3' => $request->keterangan3,
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
            'list' =>$this->BarangModel->listItem($id_barang),
        ];
        $total_roll = TStokModel::where('id_barang',$id_barang)
                        ->where("trx_stok.jumlah", ">",0)
                        ->count('id_barang');
        $total_panjang = TStokModel::where('id_barang',$id_barang)
                        ->where("trx_stok.jumlah", ">",0)
                        ->sum('trx_stok.jumlah');
        
        return view('master.benang.v_detailbenang', compact('total_roll','total_panjang'), $data);
    }
}
