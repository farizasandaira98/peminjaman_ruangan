<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRuangan extends Model
{
    use HasFactory;

    public $table = "data_ruangan";

    protected $fillable = [
       'nama_ruangan','kapasitas'
    ];
}
