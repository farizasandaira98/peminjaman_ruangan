@extends('layouts.app-master')

@section('content')
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
                        <th>Status Peminjaman</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($dataruangan as $ang)
                      <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $ang->nama_ruangan }}</td>
                      <td>{{ $ang->kapasitas }} Orang</td>
                      <td>{{ $ang->status_peminjaman }}</td>
                      <td>
                        <a href="/dataruangan/edit/{{ $ang->id }}" class="btn btn-warning" style="width:100%;">Edit</a></br></br>
                        <a href="/dataruangan/destroy/{{ $ang->id }}" class="btn btn-danger" style="width:100%;">Hapus</a>
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
        </br>
        <div class="card">
          <div class="card-body">
                  <table>
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Status Peminjaman</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($dataruangan as $ang)
                      <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $ang->nama_ruangan }}</td>
                      <td>{{ $ang->kapasitas }}</td>
                      <td>{{ $ang->status_peminjaman }}</td>
                      <td>
                        @if($ang->status_peminjaman === "Tersedia")
                        <a href="/pinjamruangan{{ $ang->id }}" class="btn btn-warning" style="width:100%;">Pinjam Ruangan</a></br></br>
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
                {{ $dataruangan->links() }}
                </div>
        </div><!-- /.container-fluid -->
        @endguest
      </section>
      <!-- /.Main Content -->
      @endsection
