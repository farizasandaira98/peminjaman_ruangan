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
                DATA PEMINJAMAN - <strong>TAMBAH DATA</strong>
            </div>
            <div class="card-body">

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                 <button type="button" class="close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
                </div>
                @endif

                @if ($dalamrentangwaktu !== null)
                <div class="alert alert-danger alert-block">
                 <button type="button" class="close" data-dismiss="alert"></button>
                 <strong>{{ $dalamrentangwaktu }}</strong>
                </div>
                @endif

                <a href="/datapeminjaman" class="btn btn-primary">Kembali</a>

                <br/>
                <br/>

                <form method="post" action="/datapeminjaman/store" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Peminjam</label>
                        <input type="text" name="nama_peminjam" class="form-control" placeholder="Nama Peminjam ..">

                        @if($errors->has('nama_peminjam'))
                        <div class="text-danger">
                            {{ $errors->first('nama_peminjam')}}
                        </div>
                        @endif
                    </div>


                    <div class="form-group">
                        <label>Keperluan Peminjaman</label>
                        <input type="text" name="keperluan_peminjaman" class="form-control" placeholder="Keperluan Peminjaman ..">

                        @if($errors->has('keperluan_peminjaman'))
                        <div class="text-danger">
                            {{ $errors->first('keperluan_peminjaman')}}
                        </div>
                        @endif
                    </div>

                    @if($ruangan === null)
                    <div class="form-group">
                        <label for="">Ruangan Yang Dipinjam</label>
                        <select id="id_ruangan" name="id_ruangan" class="form-control" placeholder="Pilih Ruangan ...">
                            @foreach($dataruangan as $ang)
                            <option value={{ $ang->id }}>{{ $ang->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                       <label>Ruangan Yang Dipinjam</label>
                       <div class="form-group">
                        <p><strong>{{ $ruangan->nama_ruangan }}</strong></p>
                       <input type="text" name="id_ruangan" value={{ $ruangan->id }} class="form-control" hidden>
                       </div>
                    @endif
                    @if($errors->has('id_ruangan'))
                    <div class="text-danger">
                        {{ $errors->first('id_ruangan')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Waktu Mulai Peminjaman</label>
                        <p style="color: red"> * Peminjaman Ruangan Hanya Dapat Dilakukan Dari Jam 08:00</p>
                        <input type="datetime-local" name="waktu_mulai_peminjaman" id="waktu_mulai_peminjaman" class="form-control">
                        @if($errors->has('waktu_mulai_peminjaman'))
                            <div class="text-danger">
                                {{ $errors->first('waktu_mulai_peminjaman') }}
                            </div>
                        @endif
                    </div>

                <div class="form-group">
                    <label>Waktu Akhir Peminjaman</label>
                    <input type="datetime-local" name="waktu_akhir_peminjaman" id="waktu_akhir_peminjaman" max="12:00:00" class="form-control">

                    @if($errors->has('waktu_mulai_peminjaman'))
                    <div class="text-danger">
                        {{ $errors->first('waktu_mulai_peminjaman')}}
                    </div>
                    @endif
                </div>

                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
        </form>

    </div>
</div>
</div>
</body>
</html>
