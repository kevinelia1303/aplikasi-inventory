<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_divisi',
        'id_jabatan',
        'created_at',
        'updated_at'
    ];
     
    protected $hidden = [
        'password',
    ];

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function allData()
    {
        return DB::table("users")
                ->join("divisi", function($join){
	                $join->on("users.id_divisi", "=", "divisi.id_divisi");
                })
                ->join("jabatan", function($join){
	                $join->on("users.id_jabatan", "=", "jabatan.id_jabatan");
                })->get();
    }

    public function detailData($id)
    {
        return DB::table("users")->join("divisi", function($join){
	            $join->on("users.id_divisi", "=", "divisi.id_divisi");
                })
                ->join("jabatan", function($join){
	                $join->on("users.id_jabatan", "=", "jabatan.id_jabatan");
                })
                ->where("id", $id)
                ->first();
    }

    public function editData($id, $data)
    {
        DB::table('users')->where('id',$id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('users')->where('id',$id)->delete();
    }
}
