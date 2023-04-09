@extends('layouts.app-master')

@section('content')


<link rel="stylesheet" href="{!! url('assets/css/ruangan.css') !!}">

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
        <h2>Data Ruangan</h2>
        </br>
        <a href="/dataruangan/create" class="btn btn-primary">Input Data Ruangan</a>
        </br></br>
        <div class="card">
          <div class="card-body">
                  <table>
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($dataruangan as $ang)
                      <tr>
                      <td>{{($dataruangan->currentPage() - 1) * $dataruangan->perPage() + $loop->iteration}}</td>
                      <td>{{ $ang->nama_ruangan }}</td>
                      <td>{{ $ang->kapasitas }} Orang</td>
                      <td>
                        <a href="/dataruangan/edit/{{ $ang->id }}" class="btn btn-warning" style="width:100%;">Edit</a></br></br>
                        <a href="/dataruangan/destroy/{{ $ang->id }}" class="btn btn-danger" style="width:100%;">Hapus</a></br></br>
                        <a href="/dataruangan/inventaris/{{ $ang->id }}" class="btn btn-primary" style="width:100%;">Lihat Inventaris Ruangan</a>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                {{ $dataruangan->links() }}
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
            <h2>Data Ruangan</h2>
        </br>
        <div class="card">
          <div class="card-body">
                  <table>
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($dataruangan as $ang)
                      <tr>
                      <td>{{($dataruangan->currentPage() - 1) * $dataruangan->perPage() + $loop->iteration}}</td>
                      <td>{{ $ang->nama_ruangan }}</td>
                      <td>{{ $ang->kapasitas }} Orang</td>
                      <td>
                        <a href="/datapeminjaman/create/{{ $ang->id }}" class="btn btn-warning" style="width:100%;">Pinjam Ruangan</a></br></br>
                        <a href="/dataruangan/inventaris/{{ $ang->id }}" class="btn btn-primary" style="width:100%;">Lihat Inventaris Ruangan</a>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                {{ $dataruangan->links() }}
                </div>
        </div><!-- /.container-fluid -->
        @endguest
      </section>
      <!-- /.Main Content -->
      @endsection
