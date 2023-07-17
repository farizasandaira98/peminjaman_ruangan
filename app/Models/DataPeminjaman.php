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

    public function datapeminjam()
    {
        return $this->belongsTo(User::class,'id_peminjam');
    }

    public $table = "data_peminjaman";

    protected $fillable = [
        'id_peminjam','id_ruangan','keperluan_peminjaman','waktu_mulai_peminjaman','waktu_akhir_peminjaman'
    ];
}
