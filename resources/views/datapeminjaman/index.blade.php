@extends('layouts.app-master')

@section('content')

<link rel="stylesheet" href="{!! url('assets/css/peminjaman.css') !!}">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @auth
            @if ($message = Session::get('success'))
                </br>
                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <strong>{{ $message }}</strong>
                    <button class="btn btn-danger float-right" onclick="window.location.href='{{ route('datapeminjaman.index') }}'">X</button>
                    </div>
                </br>
            @endif
            @if($message = Session::get('error'))
                </br>
                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <strong>{{ $message }}</strong>
                    <button class="btn btn-danger float-right" onclick="window.location.href='{{ route('datapeminjaman.index') }}'">X</button>
                    </div>
                </br>
            @endif
            @if($pesan != null)
                </br>
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <strong>{{ $pesan }}</strong>
                    <button class="btn btn-danger float-right" onclick="window.location.href='{{ route('datapeminjaman.index') }}'">X</button>
                    </div>
                </br>
            @endif
            </br>
        <h2>Data Peminjaman</h2>
        </br>
        <a href="/datapeminjaman/create" class="btn btn-primary">Input Data Peminjaman</a>
        </br></br>
        <div class="card">
          <div class="card-body">
                  <table>
                    <thead>
                        <form class="form-inline" action="/datapeminjaman/cari" method="GET">
                            <center><h5>Cari Rentang Waktu Peminjaman</h5></center>
                            <div class="form-group">
                                <input type="date" name="start" id="start" class="form-control">
                                <br>
                            </div>
                            <div class="form-group">
                                <input type="date" name="end" id="end" class="form-control">
                                <br>
                            </div>
                            <div class="form-group">
                            <button style="width: 100%" type="submit" class="btn btn-primary">Cari</button>
                        </div>
                        </form>
                        <br>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama Peminjaman</th>
                        <th>NIP</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Keperluan Peminjaman</th>
                        <th>Ruangan Yang Dipinjam</th>
                        <th>Waktu Mulai Peminjaman</th>
                        <th>Waktu Akhir Peminjaman</th>
                        @if(Auth::user()->role == 1)
                        <th>Aksi</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($datapeminjaman as $ang)
                      <tr>
                      <td>{{($datapeminjaman->currentPage() - 1) * $datapeminjaman->perPage() + $loop->iteration}}</td>
                      <td>{{ $ang->datapeminjam->nama}}</td>
                      <td>{{ $ang->datapeminjam->nip}}</td>
                      <td>{{ $ang->datapeminjam->nomor_telepon}}</td>
                      <td>{{ $ang->datapeminjam->email}}</td>
                      <td>{{ $ang->keperluan_peminjaman }}</td>
                      <td>{{ $ang->DataRuangan->nama_ruangan }}</td>
                      <td>
                      @php
                       $hari = \Carbon\Carbon::parse($ang->waktu_mulai_peminjaman)->format('l');
                       $hariindonesia = App\Http\Controllers\DataPeminjamanController::transaltehari($hari);
                      @endphp
                      {{ $hariindonesia }} {{ $ang->waktu_mulai_peminjaman }}
                      </td>
                      <td>
                        @php
                         $hari = \Carbon\Carbon::parse($ang->waktu_akhir_peminjaman)->format('l');
                         $hariindonesia = App\Http\Controllers\DataPeminjamanController::transaltehari($hari);
                        @endphp
                        {{ $hariindonesia }} {{ $ang->waktu_akhir_peminjaman }}
                        </td>
                        @if(Auth::user()->role == 1)
                      <td>
                        <a href="/datapeminjaman/destroy/{{ $ang->id }}" class="btn btn-danger" style="width:100%;">Hapus</a></br></br>
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
                {{ $datapeminjaman->links() }}
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
        </br>
        <h2>Data Peminjaman</h2>
        </br>
        <div class="card">
          <div class="card-body">
            <table>
                <thead>
                  <tr style="text-align: center;">
                    <th>No</th>
                        <th>Nama Peminjaman</th>
                        <th>NIP</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Keperluan Peminjaman</th>
                        <th>Ruangan Yang Dipinjam</th>
                        <th>Waktu Mulai Peminjaman</th>
                        <th>Waktu Akhir Peminjaman</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($datapeminjaman as $ang)
                    <tr>
                    <td>{{($datapeminjaman->currentPage() - 1) * $datapeminjaman->perPage() + $loop->iteration}}</td>
                    <td>{{ $ang->datapeminjam->nama}}</td>
                    <td>{{ $ang->datapeminjam->nip}}</td>
                    <td>{{ $ang->datapeminjam->nomor_telepon}}</td>
                    <td>{{ $ang->datapeminjam->email}}</td>
                    <td>{{ $ang->keperluan_peminjaman }}</td>
                    <td>{{ $ang->DataRuangan->nama_ruangan }}</td>
                    <td>
                    @php
                     $hari = \Carbon\Carbon::parse($ang->waktu_mulai_peminjaman)->format('l');
                     $hariindonesia = App\Http\Controllers\DataPeminjamanController::transaltehari($hari);
                    @endphp
                    {{ $hariindonesia }} {{ $ang->waktu_mulai_peminjaman }}
                    </td>
                    <td>
                      @php
                       $hari = \Carbon\Carbon::parse($ang->waktu_akhir_peminjaman)->format('l');
                       $hariindonesia = App\Http\Controllers\DataPeminjamanController::transaltehari($hari);
                      @endphp
                      {{ $hariindonesia }} {{ $ang->waktu_akhir_peminjaman }}
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
                </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                {{ $datapeminjaman->links() }}
                </div>
        </div><!-- /.container-fluid -->
        @endguest
      </section>
      <!-- /.Main Content -->
      @endsection
