@extends('admin.admin')
@section('title', 'Edit Siswa')
@section('content-title', 'Edit Siswa')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-shadow">
                <div class="card-header">
                    <a href="{{ route('siswa.index')}}" class="btn btn-info">Kembali</a>
                </div>
                <div class="card-body">
                `   @if(count($errors)> 0 )
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('siswa.update', $siswa->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="">Nama Siswa</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $siswa->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="">About</label>
                            <textarea name="about" id="name" class="form-control">{{ old ('about', $siswa->about)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Photo</label>
                            <img class="img-thumbnail" src="{{asset('storage/gambar/' . $siswa->photo)}}" width="200px" alt="">
                            <input type="file" name="photo" id="name" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                            <label for="formFile" class="form-label">Photo</label>
                            <input class="form-control" type="file" name="photo" id="formFile">
                        </div> -->
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Simpan">
                            <input class="btn btn-danger" type="reset" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection