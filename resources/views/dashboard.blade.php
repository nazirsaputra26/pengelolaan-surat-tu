@extends('layouts.template')

{{-- mengisi bagian dinamis {yield} --}}
@section('content')
    <div class="jumbotron p-4 bg-light mt-5">
        <div class="container">
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            <h1 class="display-4">Pengelolaan surat</h1>
            {{-- mengambil data dari table users sesuai login --}}
            <h5>Selamat Datang,</h5>
            {{-- <h5>Selamat Datang, {{ Auth::user()->name }}</h5> --}}
            <p class="lead">Aplikasi Manajemen untuk pekerja administator apotek. Digunakan untuk admin logistik dan kasir.</p>
        </div>
    </div>
@endsection