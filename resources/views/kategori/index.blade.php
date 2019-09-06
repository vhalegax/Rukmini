@extends("layouts.dashboard")

@section("title") Daftar Kategori @endsection 

@section('pageTitle') Daftar Kategori @endsection

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
                <a href="{{route('kategori.create')}}" class="btn btn-primary">Tambah Kategori</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><b>Nama</b></th>
                        <th><b>Deskripsi</b></th>
                        <th width="80"><b>Gambar</b></th>
                        <th width="80"><b>Aksi</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $kategori)
                        <tr>
                            <td>{{$kategori->nama}}</td>
                            <td>{!!$kategori->deskripsi!!}
                            <td>
                            @if($kategori->gambar)
                                <img 
                                src="{{asset('storage/' . $kategori->gambar)}}" 
                                width="48px"/>
                            @else 
                                No image
                            @endif
                            </td>
                            <td>
                            <a href="{{route('kategori.edit', ['id' => $kategori->id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <form  class="d-inline" action="{{route('kategori.destroy', ['id' => $kategori->id])}}" 
                            method="POST"  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Kategori?')" >
                            @csrf 
                            <input type="hidden"name="_method" value="DELETE"/>
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


