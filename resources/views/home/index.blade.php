@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            @if(Auth::user()->role == 1)
                <h1>Selamat Datang {{ Auth::user()->nama }} </h1>
                <p class="lead">Dashboard Pengelola Untuk Mengolah Data Pada Web Peminjaman Dinas PUP ESDM Daerah Istimewa Yogyakarta</p>
            @else
                <h1>Selamat Datang {{ Auth::user()->nama }} </h1>
                <p class="lead">Dashboard Peminjam Untuk Mengelola Peminjaman Ruangan Rapat Dinas PUP ESDM Daerah Istimewa Yogyakarta</p>
            @endif
        @endauth

        @guest
            <h1>Selamat Datang</h1>
            <p class="lead"><strong>Sistem Peminjaman Ruangan Rapat Dinas PUP ESDM Daerah Istimewa Yogyakarta.<strong></p>
        @endguest
    </div>
@endsection
