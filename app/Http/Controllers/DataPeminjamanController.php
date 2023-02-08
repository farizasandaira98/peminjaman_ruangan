<?php

namespace App\Http\Controllers;

use App\Models\DataPeminjaman;
use App\Models\DataRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DataPeminjamanController extends Controller
{
    public static function transaltehari($hari)
    {
        if($hari === "Sunday"){
            $hariindonesia = "Minggu";
        }elseif ($hari === "Monday") {
            $hariindonesia = "Senin";
        }elseif ($hari === "Tuesday") {
            $hariindonesia = "Selasa";
        }elseif ($hari === "Wednesday") {
            $hariindonesia = "Rabu";
        }elseif ($hari === "Thursday") {
            $hariindonesia = "Kamis";
        }elseif ($hari === "Friday") {
            $hariindonesia = "Jumat";
        }elseif ($hari === "Saturday") {
            $hariindonesia = "Sabtu";
        }

        return $hariindonesia;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $datapeminjaman = DataPeminjaman::paginate(5);
        return view('/datapeminjaman/index')
        ->with(compact('datapeminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dalamrentangwaktu = null;
        $dataruangan = DataRuangan::all();
        $ruangan = DataRuangan::where("id","=",$id)->first();
        return view('/datapeminjaman/create')
        ->with(compact("dataruangan"))
        ->with(compact("dalamrentangwaktu"))
        ->with(compact("ruangan"));
    }

    public function createadmin()
    {
        $dalamrentangwaktu = null;
        $dataruangan = DataRuangan::all();
        $ruangan = null;
        return view('/datapeminjaman/create')
        ->with(compact("dataruangan"))
        ->with(compact("dalamrentangwaktu"))
        ->with(compact("ruangan"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_peminjam' => 'required',
            'nip' => 'required',
            'nomor_telepon' => 'required',
            'keperluan_peminjaman' => 'required',
            'id_ruangan' => 'required',
            'waktu_mulai_peminjaman' => 'required',
        ];

        $messages = [
            'nama_peminjam.required'          => 'Nama Peminjaman Wajib Diisi',
            'nip.required'          => 'NIP wajib diisi',
            'nomor_telepon.required'          => 'Nomor Telepon wajib diisi',
            'keperluan_peminjaman.required'          => 'Keperluan Peminjaman Wajib wajib diisi',
            'id_ruangan.required'          => 'Ruangan Yang Akan Dipinjam Wajib Wajib Dipilih',
            'waktu_mulai_peminjaman.required'          => 'Waktu Mulai Peminjaman Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $inthour = (int)$request->waktu_peminjaman;
        $waktu_akhir_peminjaman = Carbon::parse($request->waktu_mulai_peminjaman)->addHour($inthour);
        $intidruangan = (int)$request->id_ruangan;
        $convertdatepeminjaman = Carbon::parse($request->waktu_mulai_peminjaman);

        $datatimepeminjaman = DataPeminjaman::all();
        $dataruangan = DataRuangan::all();
        foreach ($datatimepeminjaman as $ang) {
            if ($convertdatepeminjaman >= $ang->waktu_mulai_peminjaman && $convertdatepeminjaman <= $ang->waktu_akhir_peminjaman && $intidruangan == $ang->id_ruangan) {
                $dalamrentangwaktu = "Ruangan Telah Dipinjam Dalam Rentang Waktu Ini";
                if (Auth::user()) {
                    $ruangan = null;
                }else {
                    $ruangan = DataRuangan::where("id","=",$request->id_ruangan)->first();
                }
                return view('/datapeminjaman/create')
                ->with(compact("dalamrentangwaktu"))
                ->with(compact("dataruangan"))
                ->with(compact("ruangan"));
            }
        }
        $simpan = DataPeminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'nip' => $request->nip,
            'nomor_telepon' => $request->nomor_telepon,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'id_ruangan' => $request->id_ruangan,
            'waktu_mulai_peminjaman' => $request->waktu_mulai_peminjaman,
            'waktu_akhir_peminjaman' => $waktu_akhir_peminjaman,
        ]);

        if($simpan){
            Session::flash('success', 'Data Peminjaman Berhasil Ditambahkan');
            return redirect('/datapeminjaman');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan... ']);
            return redirect('/datapeminjaman');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataRuangan  $stokIkan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datapeminjaman = DataPeminjaman::where('id', $id)->first();
        $datapeminjaman->delete();

        if($datapeminjaman){
            Session::flash('success', 'Data Ruangan Berhasil Dihapus');
            return redirect('/datapeminjaman');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan... ']);
            return redirect('/datapeminjaman');
        }
    }

    // public function search(Request $request)
    // {
    //     $cari = $request->search;
    //     $hasilcari = $dataruangan = DataRuangan::where('nama_ruangan','LIKE','%'.$cari.'%')
    //     ->paginate(5);
    //     return view('/dataruangan/index', ['dataruangan' => $hasilcari]);
    // }
}
