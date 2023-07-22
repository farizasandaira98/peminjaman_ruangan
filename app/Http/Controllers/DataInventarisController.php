<?php

namespace App\Http\Controllers;

use App\Models\DataInventaris;
use App\Models\DataRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class DataInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $datainventaris = DataInventaris::where("id_ruangan","=",$id)->paginate(5);
        $id_ruangan = $id;
        $namaruangan = DataRuangan::select("nama_ruangan")->where("id","=",$id)->first();
        return view('/datainventaris/index')
        ->with(compact('datainventaris'))
        ->with(compact('namaruangan'))
        ->with(compact('id_ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $namaruangan = DataRuangan::select("nama_ruangan")->where("id","=",$id)->first();
        $id_ruangan = $id;
        return view('/datainventaris/create')
        ->with(compact('namaruangan'))
        ->with(compact('id_ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules = [
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'kualitas_barang' => 'required',
        ];

        $messages = [
            'nama_barang.required'          => 'Nama Barang Wajib Diisi',
            'jumlah_barang.required'          => 'Jumlah Barang wajib diisi',
            'kualitas_barang.required'          => 'Kualitas Barang wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $simpan = DataInventaris::create([
            'id_ruangan' => $id,
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'kualitas_barang' => $request->kualitas_barang,
        ]);

        if($simpan){
            Session::flash('success', 'Data Inventaris Berhasil Ditambahkan');
            return redirect('/dataruangan/inventaris/'.$id);
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan... ']);
            return redirect('/dataruangan/inventaris/'.$id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataRuangan  $stokIkan
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $idinventaris)
    {
        $datainventaris = DataInventaris::where('id', $idinventaris)->first();
        $namaruangan = DataRuangan::select("nama_ruangan")->where("id","=",$id)->first();
        $id_ruangan = $id;
        return view('/datainventaris/edit')
        ->with(compact('datainventaris'))
        ->with(compact('namaruangan'))
        ->with(compact('id_ruangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataRuangan  $stokIkan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idinventaris)
    {
        $rules = [
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'kualitas_barang' => 'required',
        ];

        $messages = [
            'nama_barang.required'          => 'Nama Barang Wajib Diisi',
            'jumlah_barang.required'          => 'Jumlah Barang wajib diisi',
            'kualitas_barang.required'          => 'Kualitas Barang wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $datainventaris = DataInventaris::where('id', $idinventaris)->first();

        $datainventaris->nama_barang = $request->nama_barang;
        $datainventaris->jumlah_barang = $request->jumlah_barang;
        $datainventaris->kualitas_barang = $request->kualitas_barang;
        $simpan = $datainventaris->save();

        if($simpan){
            Session::flash('success', 'Data Inventaris Berhasil Diedit');
            return redirect('/dataruangan/inventaris/'.$id);
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('/dataruangan/inventaris/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataRuangan  $stokIkan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idinventaris)
    {
        $datainventaris = DataInventaris::where('id', $idinventaris)->first();
        $datainventaris->delete();

        if($datainventaris){
            Session::flash('success', 'Data Berhasil Dihapus');
            return redirect('/dataruangan/inventaris/'.$id);
        } else {
            Session::flash('errors', ['' => 'Terjadi Kesalahan...']);
            return redirect('/dataruangan/inventaris/'.$id);
        }
    }
}
