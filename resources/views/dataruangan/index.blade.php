@extends('layouts.app-master')

@section('content')
    <<!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong>{{ $message }}</strong>
                </div>
                @endif

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
                </div>
                @endif

        <a href="/penjual/pengeluaran/tambah" class="btn btn-primary">Input Data Pengeluaran</a>
        <a href="/penjual/pengeluaran/cetak" class="btn btn-success">Cetak Pengeluaran</a>
        </br></br>
        <div class="card">
          <div class="card-body">
                  <table>
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Pengeluaran</th>
                        <th>Deskripsi</th>
                        <th>Foto Kwitansi</th>
                        <th>Created At</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($pengeluaran as $ang)
                      <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $ang->pengeluaran }}</td>
                      <td>{{ $ang->deskripsi }}</td>
                      <td><a href="{{asset('/foto_kwitansi/'.$ang->foto_kwitansi) }}"><img id="myImg"
                        src="{{asset('/foto_kwitansi/'.$ang->foto_kwitansi) }}" style='width:100px; height:120px;'></a></td>
                      <td>{{ $ang->created_at }}</td>
                      <td>
                        <a href="/penjual/pengeluaran/edit/{{ $ang->id }}" class="btn btn-warning" style="width:100%;">Edit</a></br></br>
                        <a href="/penjual/pengeluaran/hapus/{{ $ang->id }}" class="btn btn-danger" style="width:100%;">Hapus</a>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                {{ $pengeluaran->links() }}
                </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.Main Content -->
@endsection
