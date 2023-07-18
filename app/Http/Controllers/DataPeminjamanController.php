<?php

namespace App\Http\Controllers;

use App\Models\DataPeminjaman;
use App\Models\DataRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class DataPeminjamanController extends Controller
{
    public static function transaltehari($hari)
    {
        if ($hari === "Sunday") {
            $hariindonesia = "Minggu";
        } elseif ($hari === "Monday") {
            $hariindonesia = "Senin";
        } elseif ($hari === "Tuesday") {
            $hariindonesia = "Selasa";
        } elseif ($hari === "Wednesday") {
            $hariindonesia = "Rabu";
        } elseif ($hari === "Thursday") {
            $hariindonesia = "Kamis";
        } elseif ($hari === "Friday") {
            $hariindonesia = "Jumat";
        } elseif ($hari === "Saturday") {
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
        $pesan = null;
        return view('/datapeminjaman/index')
            ->with(compact('datapeminjaman'))
            ->with(compact('pesan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dataruangan = DataRuangan::where('status_ruangan', 1)->get();
        $datapeminjaman = DataPeminjaman::paginate(5);
        $pesan = "Data Ruangan Tidak Ada Yang Tersedia";
        if($dataruangan->isEmpty()){
            return view('/datapeminjaman/index')
            ->with(compact('datapeminjaman'))
            ->with(compact('pesan'));
        }
        $ruangan = DataRuangan::where("id", "=", $id)->first();
        return view('/datapeminjaman/create')
            ->with(compact("dataruangan"))
            ->with(compact("ruangan"));
    }

    public function createadmin()
    {
        $dataruangan = DataRuangan::where('status_ruangan', 1)->get();
        $datapeminjaman = DataPeminjaman::paginate(5);
        $pesan = "Data Ruangan Tidak Ada Yang Tersedia";
        if($dataruangan->isEmpty()){
            return view('/datapeminjaman/index')
            ->with(compact('datapeminjaman'))
            ->with(compact('pesan'));
        }
        $ruangan = null;
        return view('/datapeminjaman/create')
            ->with(compact("dataruangan"))
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
            'id_ruangan' => 'required',
            'keperluan_peminjaman' => 'required',
            'waktu_mulai_peminjaman' => 'required',
            'waktu_akhir_peminjaman' => 'required',

        ];

        $messages = [
            'id_ruangan.required'          => 'Ruangan Wajib Diisi',
            'keperluan_peminjaman.required'          => 'Keperluan Peminjaman Wajib wajib diisi',
            'waktu_mulai_peminjaman.required'          => 'Waktu Mulai Peminjaman Wajib Diisi',
            'waktu_akhir_peminjaman.required'          => 'Waktu Akhir Peminjaman Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $intidruangan = (int)$request->id_ruangan;
        $convertwaktumulaipeminjaman = Carbon::parse($request->waktu_mulai_peminjaman);
        $convertwaktuakhirpeminjaman = Carbon::parse($request->waktu_akhir_peminjaman);
        $start = Carbon::createFromFormat('Y-m-d\TH:i', $request->waktu_mulai_peminjaman)->setTime(8, 0, 0);
        $end = Carbon::createFromFormat('Y-m-d\TH:i', $request->waktu_mulai_peminjaman)->setTime(16, 0, 0);
        $datatimepeminjaman = DataPeminjaman::all();
        $dataruangan = DataRuangan::all();

        if ($convertwaktumulaipeminjaman < $start || $convertwaktumulaipeminjaman > $end) {
            return redirect()->back()->withErrors(['waktu_mulai_peminjaman' => 'Waktu mulai peminjaman hanya dari jam 08.00 S/d 16.00'])->withInput($request->all());
        }

        if($convertwaktuakhirpeminjaman > $end){
            return redirect()->back()->withErrors(['waktu_akhir_peminjaman' => 'Waktu Akhir Peminjaman tidak boleh lebih dari jam 16.00'])->withInput($request->all());
        }

        foreach ($datatimepeminjaman as $ang) {
            if ($convertwaktumulaipeminjaman >= $ang->waktu_mulai_peminjaman && $convertwaktumulaipeminjaman <= $ang->waktu_akhir_peminjaman && $intidruangan == $ang->id_ruangan) {
                return redirect()->back()->withErrors(['pesan' => 'Ruangan Telah Dipinjam, Silahkan Pinjam Ruangan Lain Yang Tersedia, Atau Pinjam Direntang Waktu Lain'])->withInput($request->all());
            }
        }
        $simpan = DataPeminjaman::create([
            'id_peminjam' => Auth::user()->id,
            'id_ruangan' => $request->id_ruangan,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'waktu_mulai_peminjaman' => $request->waktu_mulai_peminjaman,
            'waktu_akhir_peminjaman' => $request->waktu_akhir_peminjaman,
        ]);

        $dataruangan = DataRuangan::where('id', $request->id_ruangan)->first();
        $dataruangan->status_ruangan = 2;
        $simpandataruangan = $dataruangan->save();

        if ($simpan && $simpandataruangan) {
            Session::flash('success', 'Data Peminjaman Berhasil Ditambahkan');
            return redirect('/datapeminjaman');
        } else if (!$simpan || !$simpandataruangan){
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

        if ($datapeminjaman) {
            Session::flash('success', 'Data Ruangan Berhasil Dihapus');
            return redirect('/datapeminjaman');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan... ']);
            return redirect('/datapeminjaman');
        }
    }

    public function cari(Request $request)
{
    $start = $request->input('start');
    $end = $request->input('end');

    $hasilcari = DataPeminjaman::whereDate('waktu_mulai_peminjaman', '>=', $start)
        ->whereDate('waktu_akhir_peminjaman', '<=', $end)
        ->paginate(5);

        if ($hasilcari->isEmpty()) {
            return view('/datapeminjaman/index')
            ->with(['datapeminjaman' => $hasilcari])
            ->with(['pesan' => 'Data Tidak Ditemukan']);
        } else {
            return view('/datapeminjaman/index')
            ->with(['datapeminjaman' => $hasilcari])
            ->with(['pesan' => 'Menampilkan Pencarian Peminjaman']);
        }
}
}
