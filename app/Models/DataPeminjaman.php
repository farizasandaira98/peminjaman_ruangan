<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeminjaman extends Model
{
    use HasFactory;

    public function DataRuangan()
    {
        return $this->belongsTo(DataRuangan::class,'id_ruangan');
    }

    protected $guard = 'data_ruangan';

    protected $fillable = [
       'nama_peminjam','nip','nomor_telepon','status_kembali_kunci','keperluan_peminjaman',
       'id_ruangan','nama_admin'
    ];
}
