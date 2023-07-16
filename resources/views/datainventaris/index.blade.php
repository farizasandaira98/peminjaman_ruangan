@extends('layouts.app-master')

@section('content')

<link rel="stylesheet" href="{!! url('assets/css/inventaris.css') !!}">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @auth
            @if ($message = Session::get('success'))
                </br>
                <div class="alert alert-success alert-block">
                 <strong>{{ $message }}</strong>
                </div>
                </br>
                @endif

                @if ($message = Session::get('error'))
                </br>
                <div class="alert alert-danger alert-block">
                <strong>{{ $message }}</strong>
                </div>
                </br>
                @endif
            </br>
        <h2>Inventaris Barang {{ $namaruangan->nama_ruangan }}</h2>
        </br>
        @if(Auth::user()->role == 1)
        <a href="/dataruangan/inventaris/{{ $id_ruangan }}/create" class="btn btn-primary">Input Data Invetaris</a>
        @endif
        <a href="/dataruangan" class="btn btn-danger">Kembali Ke Data Ruangan</a>
        </br></br>
        <div class="card">
          <div class="card-body">
                  <table>
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Kualitas Barang</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($datainventaris as $ang)
                      <tr>
                      <td>{{($datainventaris->currentPage() - 1) * $datainventaris->perPage() + $loop->iteration}}</td>
                      <td>{{ $ang->nama_barang }}</td>
                      <td>{{ $ang->jumlah_barang }}</td>
                      <td>
                        @if ($ang->kualitas_barang == 1)
                        Bagus
                        @else
                        Rusak
                        @endif
                      </td>
                      @if(Auth::user()->role == 1)
                      <td>
                        <a href="/dataruangan/inventaris/{{ $id_ruangan }}/edit/{{ $ang->id }}" class="btn btn-warning" style="width:100%;">Edit</a></br></br>
                        <a href="/dataruangan/inventaris/{{ $id_ruangan }}/destroy/{{ $ang->id }}" class="btn btn-danger" style="width:100%;">Hapus</a></br></br>
                      </td>
                      @endif
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                {{ $datainventaris->links() }}
                </div>
        </div><!-- /.container-fluid -->
        @endauth

        @guest
            @if ($message = Session::get('success'))
                </br>
                <div class="alert alert-success alert-block">
                 <strong>{{ $message }}</strong>
                </div>
                </br>
                @endif

                @if ($message = Session::get('error'))
                </br>
                <div class="alert alert-danger alert-block">
                <strong>{{ $message }}</strong>
                </div>
                </br>
                @endif
            </br>
            <h2>Inventaris Barang {{ $namaruangan->nama_ruangan }}</h2>
        </br>
        <a href="/dataruangan" class="btn btn-danger">Kembali Ke Data Ruangan</a>
        </br>
    </br>
        <div class="card">
          <div class="card-body">
            <table>
                <thead>
                  <tr style="text-align: center;">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Kualitas Barang</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($datainventaris as $ang)
                  <tr>
                  <td>{{($datainventaris->currentPage() - 1) * $datainventaris->perPage() + $loop->iteration}}</td>
                  <td>{{ $ang->nama_barang }}</td>
                  <td>{{ $ang->jumlah_barang }}</td>
                  <td>
                    @if ($ang->kualitas_barang == 1)
                    Bagus
                    @else
                    Rusak
                    @endif
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
                </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                {{ $datainventaris->links() }}
                </div>
        </div><!-- /.container-fluid -->
        @endguest
      </section>
      <!-- /.Main Content -->
      @endsection
