@extends('admin.admin')
@section('title', 'Tambah Project')
@section('content-title', 'Tambah Project - '.$siswa->name)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6>Tambah Project</h6>
            </div>
            <div class="card-body">
                    @if(count($errors)> 0 )
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form action="{{ route('project.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                    <div class="form-group">
                        <label for="project_name">Nama Project</label>
                        <input class="form-control" type="text" name="project_name" placeholder="Nama Project">
                    </div>
                    <div class="form-group">
                        <label for="project_date">Tanggal Project</label>
                        <input class="form-control" type="date" name="project_date" placeholder="Tanggal Project">
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto Project</label>
                        <input class="form-control" type="file" name="photo">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-danger" type="reset" value="Reset">
                        <input class="btn btn-success" type="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection