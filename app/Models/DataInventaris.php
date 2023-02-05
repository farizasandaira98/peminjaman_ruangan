<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataInventaris extends Model
{
    use HasFactory;

    public function DataRuangan()
    {
        return $this->belongsTo(DataRuangan::class,'id_ruangan');
    }

    protected $guard = 'data_inventaris';

    protected $fillable = [
       'id_ruangan','nama_barang','jumlah_barang','kualitas_barang'
    ];
}
