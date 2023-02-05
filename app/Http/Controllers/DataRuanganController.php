<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class DataRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $dataruangan = DataRuangan::paginate(5);
        return view('/dataruangan/index')
        ->with(compact('dataruangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dataruangan/create');
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
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'status_peminjaman' => 'required',
        ];

        $messages = [
            'nama_ruangan.required'          => 'Nama Ruangan Wajib Diisi',
            'kapasitas.required'          => 'Kapasitas wajib diisi',
            'status_peminjaman.required'          => 'Status Peminjaman wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $statuspeminjaman = "Belum Kembali";

        $simpan = DataRuangan::create([
            'nama_ruangan' => $request->nama_ruangan,
            'kapasitas' => $request->kapasitas,
            'status_peminjaman' => $request->statuspeminjaman,
        ]);

        if($simpan){
            Session::flash('success', 'Data Ruangan Berhasil Ditambahkan');
            return redirect('/dataruangan');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan... ']);
            return redirect('/dataruangan');
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
        $dataruangan = DataRuangan::where('id', $id)->first();
        return view('/dataruangan/edit')
        ->with(compact('dataruangan'));
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
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'status_peminjaman' => 'required',
        ];

        $messages = [
            'nama_ruangan.required'          => 'Nama Ruangan Wajib Diisi',
            'kapasitas.required'          => 'Kapasitas wajib diisi',
            'status_peminjaman.required'          => 'Status Peminjaman wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $dataruangan = DataRuangan::where('id', $id)->first();

        $dataruangan->nama_ruangan = $request->nama_ruangan;
        $dataruangan->kapasitas = $request->kapasitas;
        $dataruangan->foto_kwitansi = $request->status_peminjaman;
        $simpan = $dataruangan->save();

        if($simpan){
            Session::flash('success', 'Data Ruangan Berhasil Diedit');
            return redirect('/dataruangan');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('/dataruangan/tambah');
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
        $dataruangan = DataRuangan::where('id',$id)->first();
        $dataruangan->delete();

        if($dataruangan){
            Session::flash('success', 'Data Berhasil Dihapus');
            return redirect('penjual/dataruangan');
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('penjual/dataruangan');
        }
    }

    public function search(Request $request)
    {
        $cari = $request->search;
        $hasilcari = $dataruangan = DataRuangan::where('nama_ruangan','LIKE','%'.$cari.'%')
        ->paginate(5);
        return view('/dataruangan/index', ['dataruangan' => $hasilcari]);
    }

}
