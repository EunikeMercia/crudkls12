@extends('admin.admin')
@section('title', 'Master Project')
@section('content-title', 'Master Project')
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
    <div class="col-5">
        <div class="card shadow">
            <div class="card-header">
                Data Siswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($siswas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                        <a class="btn btn-sm btn-info" onclick="show({{ $data->id }})"><i class="fas fa-folder-open"></i></a>
                            <a class="btn btn-sm btn-success" href="{{ route('project.add', $data->id)}}"><i class="fas fa-plus"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card shadow">
            <div class="card-header">
                <h6>List Project</h6>
            </div>
            <div id="project" class="card-body">
                <div class="text-center">Silahkan pilih siswa terlebih dahulu</div>
            </div>
        </div>
    </div>
</div>

<script>
    function show(id){
        $.get('project/' + id, function(data){
            $('#project').html(data);
        });
    }
</script>
@endsection