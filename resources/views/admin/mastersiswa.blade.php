@extends('admin.admin')
@section('title', 'Master Siswa')
@section('content-title', 'Master Siswa')
@section('content')
@if (session()->has('message'))
    <div class="alert alert-success">
        {{session()->get('message');}}
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error');}}
    </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card-shadow">
            <div class="card-header">
                <a href="{{ route('siswa.create')}}" class="btn btn-dark">Create</a>
            </div>
            <div class="card">
                <table class="table table-stripped table-border">
                    <thead>
                        <th>#</th>
                        <th>Nama</th>
                        <th>About</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </thead>
                    @foreach($data as $siswa)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$siswa->name}}</td>
                        <td>{{ Str::substr($siswa->about, 0, 50)}} ... </td>
                        <td><img src="{{asset('storage/gambar/' . $siswa->photo)}}" width="200px" alt=""></td>
                        <td>
                            <div class="d-flex justify-content-evenly" style="gap:15px">
                                <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-info">Edit</a>
                                <form action="{{ route('siswa.delete', $siswa->id) }}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection