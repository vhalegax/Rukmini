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

    <div class="card shadow mb-2 ">
        <div class="submenu">
            <a class="nav-link {{Request::path() == 'karyawan/kategori' ? 'aktif' : ''}}" href="{{route('kategori.index')}}">Terpakai</a>
            <a class="nav-link {{Request::path() == 'karyawan/kategori/trash' ? 'aktif' : ''}}" href="{{route('kategori.trash')}}">Tempat Sampah</a>
        </div>
    </div>
            
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
                        <th><b>Name</b></th>
                        <th><b>Slug</b></th>
                        <th><b>Image</b></th>
                        <th><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $kategori)
                        <tr>
                            <td>{{$kategori->name}}</td>
                            <td>{{$kategori->slug}}</td>
                            <td>
                            @if($kategori->image)
                                <img 
                                src="{{asset('storage/' . $kategori->image)}}" 
                                width="48px"/>
                            @else 
                                No image
                            @endif
                            </td>
                            <td>
                            <a href="{{route('kategori.restore', ['id' => $kategori->id])}}" class="btn btn-success btn-sm">Restore</a>
                            <form  class="d-inline" action="{{route('kategori.delete-permanent', ['id' => $kategori->id])}}" 
                            method="POST"  onsubmit="return confirm('Delete this category permanently?')" >

                            @csrf 

                            <input type="hidden"name="_method" value="DELETE"/>

                            <input type="submit"class="btn btn-danger btn-sm" value="Delete"/>

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
