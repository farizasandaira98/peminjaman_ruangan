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
                DATA INVENTARIS - <strong> {{ strtoupper($namaruangan->nama_ruangan) }} </strong>- <strong>TAMBAH DATA</strong>
            </div>
            <div class="card-body">

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                 <button type="button" class="close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
                </div>
                @endif

                <a href="/dataruangan/inventaris/{{ $id_ruangan }}" class="btn btn-primary">Kembali</a>
                <br/>
                <br/>

                <form method="post" action="/dataruangan/inventaris/{{ $id_ruangan }}/store" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang ..">

                        @if($errors->has('nama_barang'))
                        <div class="text-danger">
                            {{ $errors->first('nama_barang')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Jumlah Barang</label>
                        <input type="text" name="jumlah_barang" class="form-control" placeholder="Jumlah Barang ..">

                        @if($errors->has('jumlah_barang'))
                        <div class="text-danger">
                            {{ $errors->first('jumlah_barang')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Kualitas Barang</label>
                        <select class="form-control" id="kualitas_barang" name="kualitas_barang">
                        <option value="Bagus">Bagus</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                    @if($errors->has('kualitas_barang'))
                        <div class="text-danger">
                            {{ $errors->first('kualitas_barang')}}
                        </div>
                        @endif
                </br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>

        </form>

    </div>
</div>
</div>
</body>
</html>
