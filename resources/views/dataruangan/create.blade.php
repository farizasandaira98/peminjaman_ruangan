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
                DATA RUANGAN - <strong>TAMBAH DATA</strong>
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

                <form method="post" action="/dataruangan/store" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" class="form-control" placeholder="Nama Ruangan ..">

                        @if($errors->has('nama_ruangan'))
                        <div class="text-danger">
                            {{ $errors->first('nama_ruangan')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Kapasitas</label>
                        <input type="text" name="kapasitas" class="form-control" placeholder="Kapasitas ..">

                        @if($errors->has('kapasitas'))
                        <div class="text-danger">
                            {{ $errors->first('kapasitas')}}
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
