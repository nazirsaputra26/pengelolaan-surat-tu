@extends('layouts.template')

@section('content')
    <form action="{{route('user.store')}}" method="post" class="card bg-light mt-5 p-5">
        {{--sebagai-token-akses-database --}}
        {{-- jika terjadi error di validasi, akan ditampilkan bagian error nya : --}}
        @csrf
        @if ($errors->any())
            <ul class="alert alert-danger p-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{-- jika berhasil munculkan notifnya : --}}
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>            
        @endif
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama User :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
@endsection