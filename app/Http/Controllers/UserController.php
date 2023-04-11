<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\divisiModel;
use App\Models\jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->User = new User();
        // $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'user'=> $this->User->allData(),
        ];
        
        return view('master.user.v_user', $data);
    }

    public function add()
    {
        $divisi = divisiModel::all();
        $jabatan = jabatan::all();
        return view('master.user.v_adduser', compact('divisi','jabatan'));
    }

    public function edit($id)
    {
        if (!$this->User->detailData($id)) {
           abort(404);
        }
        $data = [
            'user' =>$this->User->detailData($id),
        ];
        $divisi = divisiModel::all();
        $jabatan = jabatan::all();
        
        return view('master.user.v_edituser', $data, compact('divisi','jabatan'));
    }

    public function insert(Request $request)
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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_jabatan' => $request->Jabatan,
            'id_divisi' => $request->Divisi,
        ]);

        return redirect('/user')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        if ($request->password <> "") {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan' => $request->Jabatan,
            'divisi' => $request->Divisi,
        ];
        $this->User->editData($id,$data);
        }else{
           $data = [
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->Jabatan,
            'divisi' => $request->Divisi,
        ];
        $this->User->editData($id,$data); 
        }

        return redirect('/user')->with('pesan','Data berhasil diupdate');
    }

    public function delete($id)
    {
       $this->User->deleteData($id);
       return redirect('/user')->with('pesan','Data berhasil dihapus');
    }
}
