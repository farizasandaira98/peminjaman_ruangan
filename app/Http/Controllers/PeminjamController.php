<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class PeminjamController extends Controller
{
    public function index()
    {
        $datapeminjam = User::where('role','=',2)->paginate(5);
        return view('/datapeminjam/index')
            ->with(compact("datapeminjam"));
    }

    public function destroy($id)
    {
        $datapeminjam = User::where('id', $id)->first();
        $datapeminjam->delete();

        if ($datapeminjam) {
            Session::flash('success', 'Data Peminjam Berhasil Dihapus');
            return redirect('/datapeminjam');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan... ']);
            return redirect('/datapeminjam');
        }
    }
}
