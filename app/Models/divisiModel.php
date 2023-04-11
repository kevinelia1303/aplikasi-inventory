<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisiModel extends Model
{
    protected $table = 'divisi';

    protected $fillable = [
        'id_divisi',
        'nama_divisi',
    ];
}
