@extends("layouts.dashboard")

@section("title") Daftar Rekening @endsection 

@section('pageTitle') Daftar Rekening @endsection

@section("content")          
    @if(session('status'))
    <div class="row">
            <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
    </div>
    @endif 
            
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="{{route('rekening.create')}}" class="btn btn-primary">Tambah Rekening</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th width="20%"><b>Jenis Rekening</b></th>
                        <th width="25%"><b>Atas Nama</b></th>
                        <th width="20%"><b>Nomor</b></th>
                        <th width="20%"><b>Gambar</b></th>
                        <th width="15%"><b>Aksi</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekening as $rekening)
                        <tr>
                            <td>{{$rekening->nama}}</td>
                            <td>{{$rekening->AN}}</td>
                            <td>{{$rekening->nomor}}</td>
                            <td>
                            @if($rekening->gambar)
                                <img 
                                src="{{asset('storage/' . $rekening->gambar)}}" 
                                width="150px"/>
                            @else 
                                No image
                            @endif
                            </td>
                            <td>   
                                <a href="{{route('rekening.edit', ['id' => $rekening->id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <form  class="d-inline" action="{{route('rekening.destroy', ['id' => $rekening->id])}}" 
                                method="POST" onsubmit="return confirm('Hapus Rekening?')">
                                @csrf 
                                <input type="hidden"  value="DELETE"  name="_method">
                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

