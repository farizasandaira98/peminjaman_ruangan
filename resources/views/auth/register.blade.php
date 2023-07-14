@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('register.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('images/bootstrap-logo.svg') !!}" alt="" width="72" height="57">
        @auth
        @if(Auth::user()->role = 1 )
        <h1 class="h3 mb-3 fw-normal">Daftar Pengelola Dalam Sistem</h1>
        @endif
        @endauth
        @guest
        <h1 class="h3 mb-3 fw-normal">Daftar Peminjam Dalam Sistem</h1>
        @endguest
        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingEmail">Email</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Nama" required="required" autofocus>
            <label for="floatingName">Nama</label>
            @if ($errors->has('nama'))
                <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="nip" value="{{ old('nip') }}" placeholder="NIP" required="required" autofocus>
            <label for="floatingName">NIP</label>
            @if ($errors->has('nip'))
                <span class="text-danger text-left">{{ $errors->first('nip') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Nomor Telepon" required="required" autofocus>
            <label for="floatingName">Nomor Telepon</label>
            @if ($errors->has('nomor_telepon'))
                <span class="text-danger text-left">{{ $errors->first('nomor_telepon') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="jabatan" value="{{ old('jabatan') }}" placeholder="Jabatan" required="required" autofocus>
            <label for="floatingName">Jabatan</label>
            @if ($errors->has('jabatan'))
                <span class="text-danger text-left">{{ $errors->first('jabatan') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Sandi</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Konfirmasi Sandi</label>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        @auth
        @if(Auth::user()->role = 1 )
        <div class="form-group form-floating mb-3">
            <input hidden type="number" class="form-control" name="role" value="1" required="required">
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
        @endif
        @endauth
        @guest
        <div class="form-group form-floating mb-3">
            <input hidden type="number" class="form-control" name="role" value="2" required="required">
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
        @endguest
        <button class="w-100 btn btn-lg btn-primary" type="submit">Daftar</button>

        @include('auth.partials.copy')
    </form>
@endsection
