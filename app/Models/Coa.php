<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'level',
        'tipe',
        'posisi',
        'header_akun'
    ];
}
