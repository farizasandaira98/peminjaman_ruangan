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
                DATA RUANGAN - <strong>EDIT DATA</strong>
            </div>
            <div class="card-body">

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                 <button type="button" class="close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
                </div>
                @endif

                <a href="/dataruangan" class="btn btn-primary">Kembali</a>
                <br/>
                <br/>

                <form method="post" action="/dataruangan/update/{{ $dataruangan->id }}" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" class="form-control" value={{ $dataruangan->nama_ruangan }} placeholder="Nama Ruangan ..">

                        @if($errors->has('nama_ruangan'))
                        <div class="text-danger">
                            {{ $errors->first('nama_ruangan')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Kapasitas</label>
                        <input type="text" name="kapasitas" class="form-control" value={{ $dataruangan->kapasitas }} placeholder="Kapasitas ..">

                        @if($errors->has('kapasitas'))
                        <div class="text-danger">
                            {{ $errors->first('kapasitas')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                            <label><strong>Status Peminjaman</strong></label>
                            <select class="form-control" id="status_peminjaman" name="status_peminjaman">
                            @if($dataruangan->status_peminjaman === "Tersedia")
                            <option value="Tersedia">Tersedia</option>
                            <option value="Di Pinjam">Di Pinjam</option>
                            @elseif($dataruangan->status_peminjaman === "Di Pinjam")
                            <option value="Di Pinjam">Di Pinjam</option>
                            <option value="Tersedia">Tersedia</option>
                            @endif
                        </select>


                        @if($errors->has('status_peminjaman'))
                        <div class="text-danger">
                            {{ $errors->first('status_peminjaman')}}
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
