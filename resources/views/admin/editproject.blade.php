@extends('admin.admin')
@section('title', 'Edit Project')
@section('content-title', 'Edit Project')
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
                <form action="{{ route('project.update', $data->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="project_name">Nama Project</label>
                        <input class="form-control" type="text" name="project_name" placeholder="Nama Project" value="{{ old('project_name', $data->project_name)}}">
                    </div>
                    <div class="form-group">
                        <label for="project_date">Tanggal Project</label>
                        <input class="form-control" type="date" name="project_date" placeholder="Tanggal Project" value="{{ old('project_date', $data->project_date)}}">
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto Project</label>
                        <img class="img-thumbnail" src="{{asset('storage/project/' . $data->photo)}}" width="200px" alt="">
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