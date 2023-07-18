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
        <h2>Data Peminjam</h2>
        </br></br>
        <div class="card">
          <div class="card-body">
                  <table>
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($datapeminjam as $ang)
                      <tr>
                        <td>{{( $datapeminjam->currentPage() - 1) * $datapeminjam->perPage() + $loop->iteration}}</td>
                        <td>{{ $ang->nip }}</td>
                        <td>{{ $ang->nama }}</td>
                        <td>{{ $ang->jabatan }}</td>
                        <td>{{ $ang->nomor_telepon }}</td>
                        <td>{{ $ang->email }}</td>
                        <td>
                            <a href="/datapeminjam/hapus/{{ $ang->id }}" class="btn btn-danger" style="width:100%;">Hapus</a></br></br>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                {{ $datapeminjam->links() }}
                </div>
        </div><!-- /.container-fluid -->
        @endauth
      </section>
      <!-- /.Main Content -->
      @endsection
