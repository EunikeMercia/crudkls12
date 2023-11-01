@if($data->isEmpty())
    <h6>Siswa belum memilih Project</h6>
@else
@foreach($data as $item)
 <div class="card">
    <div class="card-header">
        <h6>{{ $item->project_name }}</h6>
        <div class="card-body">
            <h6>Tanggal: </h6>
            <p>{{$item->project_date}}</p>
            <h6>Photo : </h6>
            <img class="img-thumbnail" src="{{asset('storage/project/' . $item->photo)}}" width="200px" alt="">
        </div>
        <div class="card-footer d-flex justify-content-end" style="gap:10px">
            <a href="{{ route('project.edit', $item->id) }}" class="btn btn-outline-info"><i class="fas fa-solid fa-pen"></i></a>
            <form action="{{ route('project.destroy', $item->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">
                    <i class="fas fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
 </div>
@endforeach
@endif