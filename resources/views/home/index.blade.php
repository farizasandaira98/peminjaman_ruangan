@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Selamat Datang Admin</h1>
        <p class="lead">Dashboard Admin Untuk Mengolah Data Pada Web Peminjaman Dinas PUP ESDM Daerah Istimewa Yogyakarta</p>
        {{-- <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a> --}}
        @endauth

        @guest
        <h1>Selamat Datang</h1>
        <p class="lead">Web Peminjaman Ruangan Rapat Dinas PUP ESDM Daerah Istimewa Yogyakarta.</p>
        @endguest
    </div>
@endsection
