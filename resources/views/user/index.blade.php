@extends('layouts.template')

{{-- isi bagian yield --}}
@section('content')
    @if (Session::get('success'))
    <br>
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    @if (Session::get('deleted'))
        <br>
        <div class="alert alert-success">
            {{Session::get('deleted')}}
        </div>
    @endif
    <br>
    <div class="d-flex justify-content-end">
        <a class="nav-link" href="#">Tambah data</a>
    </div>
    <table class="table mt-5 table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                {{-- <th>password</th> --}}
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($users as $item)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['email']}}</td>
                {{-- <td>{{$item['password']}}</td> --}}
                <td>{{$item['role']}}</td>
                <td class="d-flex">
                    <a href="#" class="btn btn-success">Edit</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" class="ms-3" style="margin: 0px 10px;">
                    Hapus
                    </button>
                </td>
                </tr>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda ingin menghapus data ini
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <form action="" class="ms-3">
                        {{-- Menimpa atau mengubahj method post menjadi method DELETE sesuai dengan method route(::delete) --}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark">Hapus</button>
                    </form>
                    {{-- </div> --}}
                </form>
                    </div>
                </div>
                </div>
            @endforeach

        </tbody>
        
    </table>
    <div class="d-flex justify-content-end">
        @if ($users->count())
            {{$users->links()}}
        @endif
    </div>
@endsection
<!-- Modal -->
