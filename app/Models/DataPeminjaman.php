<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeminjaman extends Model
{
    use HasFactory;

    public function dataruangan()
    {
        return $this->belongsTo(DataRuangan::class,'id_ruangan');
    }

    public $table = "data_peminjaman";

    protected $fillable = [
       'nama_peminjam','nip','nomor_telepon','keperluan_peminjaman',
       'id_ruangan','waktu_mulai_peminjaman','waktu_akhir_peminjaman'
    ];
}
