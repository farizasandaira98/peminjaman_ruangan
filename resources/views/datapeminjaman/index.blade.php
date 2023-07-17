@extends('layouts.app-master')

@section('content')

<link rel="stylesheet" href="{!! url('assets/css/peminjaman.css') !!}">

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
            @if($errors->has('pesan'))
                </br>
                    <div class="alert alert-danger alert-block">
                    <strong>{{ $errors->first('pesan')}}</strong>
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
                        <form class="form-inline" action="" method="GET">
                            <div class="form-group">
                                <input type="datetime-local" name="waktu_akhir_peminjaman" id="waktu_akhir_peminjaman" max="12:00:00" class="form-control">
                                <br>
                            </div>
                            <div class="form-group">
                                <input type="datetime-local" name="waktu_akhir_peminjaman" id="waktu_akhir_peminjaman" max="12:00:00" class="form-control">
                                <br>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
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
