<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRuangan extends Model
{
    use HasFactory;

    protected $guard = 'data_ruangan';

    protected $fillable = [
       'nama_ruangan','kapasitas','status_peminjaman'
    ];
}
