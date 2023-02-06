<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                DATA PEMINJAMAN - <strong>EDIT DATA</strong>
            </div>
            <div class="card-body">

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                 <button type="button" class="close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
                </div>
                @endif

                <a href="/datapeminjaman" class="btn btn-primary">Kembali</a>
                <br/>
                <br/>

                <form method="post" action="/datapeminjaman/update/{{ $datapeminjaman->id }}" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Peminjam</label>
                        <input type="text" name="nama_peminjam" value={{ $datapeminjaman->nama_peminjam }} class="form-control" placeholder="Nama Peminjam ..">

                        @if($errors->has('nama_peminjam'))
                        <div class="text-danger">
                            {{ $errors->first('nama_peminjam')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" value={{ $datapeminjaman->nip }} placeholder="Nomor Induk Pegawai ..">

                        @if($errors->has('nip'))
                        <div class="text-danger">
                            {{ $errors->first('nip')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control" value={{ $datapeminjaman->nomor_telepon }} placeholder="Nomor Telepon ..">

                        @if($errors->has('nomor_telepon'))
                        <div class="text-danger">
                            {{ $errors->first('nomor_telepon')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                            <label>Status Kembali Kunci</label>
                            <select class="form-control" id="status_kembali_kunci" name="status_kembali_kunci">
                            <option value="Belum Di Kembalikan">Belum Di Kembalikan</option>
                            <option value="Telah Di Kembalikan">Telah Di Kembalikan</option>
                        </select>


                        @if($errors->has('status_kembali_kunci'))
                        <div class="text-danger">
                            {{ $errors->first('status_kembali_kunci')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Keperluan Peminjaman</label>
                        <input type="text" name="keperluan_peminjaman" class="form-control" value={{ $datapeminjaman->keperluan_peminjaman }} placeholder="Keperluan Peminjaman ..">

                        @if($errors->has('keperluan_peminjaman'))
                        <div class="text-danger">
                            {{ $errors->first('keperluan_peminjaman')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Ruangan Yang Dipinjam</label>
                        <select id="id_ruangan" name="id_ruangan" type="text" class="form-control" placeholder="Pilih Ruangan ...">
                            @foreach($dataruangan as $ang)
                            <option {{ $ang->id }}>{{ $ang->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('id_ruangan'))
                    <div class="text-danger">
                        {{ $errors->first('id_ruangan')}}
                    </div>
                    @endif

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Simpan">
                </div>
        </form>

    </div>
</div>
</div>

</body>
</html>
