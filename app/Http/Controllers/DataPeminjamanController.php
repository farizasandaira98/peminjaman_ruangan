<?php

namespace App\Http\Controllers;

use App\Models\DataPeminjaman;
use App\Models\DataRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class DataPeminjamanController extends Controller
{
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
    public function create()
    {
        $dataruangan = DataRuangan::all();
        return view('/datapeminjaman/create')
        ->with(compact("dataruangan"));
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
            'status_kembali_kunci' => 'required',
            'keperluan_peminjaman' => 'required',
            'id_ruangan' => 'required',
        ];

        $messages = [
            'nama_peminjam.required'          => 'Nama Peminjaman Wajib Diisi',
            'nip.required'          => 'NIP wajib diisi',
            'nomor_telepon.required'          => 'Nomor Telepon wajib diisi',
            'status_kembali_kunci.required'          => 'Nomor Telepon wajib diisi',
            'keperluan_peminjaman.required'          => 'Keperluan Peminjaman Wajib wajib diisi',
            'id_ruangan.required'          => 'Ruangan Yang Akan Dipinjam Wajib Wajib Dipilih',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $simpan = DataPeminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'nip' => $request->nip,
            'nomor_telepon' => $request->nomor_telepon,
            'status_kembali_kunci' => $request->status_kembali_kunci,
            'keperluan_peminjaman' => $request->keperluan_peminjaman,
            'id_ruangan' => $request->id_ruangan,
        ]);

        if($simpan){
            Session::flash('success', 'Data Ruangan Berhasil Ditambahkan');
            return redirect('/datapeminjaman');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan... ']);
            return redirect('/datapeminjaman');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataRuangan  $stokIkan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataruangan = DataRuangan::all();
        // $datapeminjaman = DataPeminjaman::where('id', $id)->first();
        return view('/dataruangan/edit')
        ->with(compact('dataruangan'));
        // ->with(compact('datapeminjaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataRuangan  $stokIkan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_peminjam' => 'required',
            'nip' => 'required',
            'nomor_telepon' => 'required',
            'status_kembali_kunci' => 'required',
            'keperluan_peminjaman' => 'required',
            'id_ruangan' => 'required',
        ];

        $messages = [
            'nama_peminjam.required'          => 'Nama Peminjaman Wajib Diisi',
            'nip.required'          => 'NIP wajib diisi',
            'nomor_telepon.required'          => 'Nomor Telepon wajib diisi',
            'status_kembali_kunci.required'          => 'Nomor Telepon wajib diisi',
            'keperluan_peminjaman.required'          => 'Keperluan Peminjaman Wajib wajib diisi',
            'id_ruangan.required'          => 'Ruangan Yang Akan Dipinjam Wajib Wajib Dipilih',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $datapeminjaman = DataPeminjaman::where('id', $id)->first();

        $datapeminjaman->nama_peminjam = $request->nama_peminjam;
        $datapeminjaman->nip = $request->nip;
        $datapeminjaman->nomor_telepon = $request->nomor_telepon;
        $datapeminjaman->status_kembali_kunci = $request->status_kembali_kunci;
        $datapeminjaman->keperluan_peminjaman = $request->keperluan_peminjaman;
        $datapeminjaman->id_ruangan = $request->id_ruangan;
        $simpan = $datapeminjaman->save();

        if($simpan){
            Session::flash('success', 'Data Ruangan Berhasil Ditambahkan');
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
            Session::flash('success', 'Data Ruangan Berhasil Ditambahkan');
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
