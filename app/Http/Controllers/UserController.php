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
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //return $request->all();
        // DB::enableQueryLog();
        $name=$request->name;
        $Divisi1=$request->Divisi;
        $Jabatan1=$request->Jabatan;
        $divisi = divisiModel::all();
        $jabatan = jabatan::all();
        if (auth()->user()->id_jabatan == 1 ) {
            if ($name OR $Divisi1 OR $Jabatan1 <> "") {
            $user=User::join('jabatan', 'users.id_jabatan','=','jabatan.id_jabatan')
                ->join("divisi", "users.id_divisi", '=',"divisi.id_divisi")
                ->where("users.name", "like", '%'.$name.'%')
                ->where("users.id_divisi", "like", '%'.$Divisi1)
                ->where("users.id_jabatan", "like", '%'.$Jabatan1)
                ->get();
            }else{
            $user=User::join('jabatan', 'users.id_jabatan','=','jabatan.id_jabatan')
                    ->join("divisi", "users.id_divisi", '=',"divisi.id_divisi")
                    ->where("users.id_divisi", "=", 1)
                    ->get();
            }
        }elseif (auth()->user()->id_jabatan == 3 ) {
            if ($name OR $Divisi1 OR $Jabatan1 <> "") {
            $user=User::join('jabatan', 'users.id_jabatan','=','jabatan.id_jabatan')
                ->join("divisi", "users.id_divisi", '=',"divisi.id_divisi")
                ->where("users.name", "like", '%'.$name.'%')
                ->where("users.id_divisi", "like", '%'.$Divisi1)
                ->where("users.id_jabatan", "like", '%'.$Jabatan1)
                ->get();
            }else{
            $user=User::join('jabatan', 'users.id_jabatan','=','jabatan.id_jabatan')
                    ->join("divisi", "users.id_divisi", '=',"divisi.id_divisi")
                    ->where("users.id_divisi", "=", 2)
                    ->get();
            }
        }elseif (auth()->user()->id_jabatan == 5) {
            if ($name OR $Divisi1 OR $Jabatan1 <> "") {
            $user=User::join('jabatan', 'users.id_jabatan','=','jabatan.id_jabatan')
                ->join("divisi", "users.id_divisi", '=',"divisi.id_divisi")
                ->where("users.name", "like", '%'.$name.'%')
                ->where("users.id_divisi", "like", '%'.$Divisi1)
                ->where("users.id_jabatan", "like", '%'.$Jabatan1)
                ->get();
            }else{
            $user=User::join('jabatan', 'users.id_jabatan','=','jabatan.id_jabatan')
                    ->join("divisi", "users.id_divisi", '=',"divisi.id_divisi")
                    ->get();
            }
        }else {
            return redirect('/');
        }
        
        
        // dd(DB::getQueryLog());
        return view('master.user.v_user',compact('user','divisi','jabatan'));
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
            'id_jabatan' => $request->Jabatan,
            'id_divisi' => $request->Divisi,
        ];
        $this->User->editData($id,$data);
        }else{
           $data = [
            'name' => $request->name,
            'email' => $request->email,
            'id_jabatan' => $request->Jabatan,
            'id_divisi' => $request->Divisi,
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
