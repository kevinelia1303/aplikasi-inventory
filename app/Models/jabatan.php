<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $table = 'jabatan';

    protected $fillable = [
        'id_jabatan',
        'nama_jabatan',
    ];
}
