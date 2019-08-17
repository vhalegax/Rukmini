@extends("layouts.dashboard")


@section("title") Daftar Baju @endsection 

@section('pageTitle') Daftar Baju @endsection

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
            <a class="nav-link {{Request::get('status') == NULL && Request::path() == 'karyawan/bajus' ? 'aktif' : ''}}" href="{{route('bajus.index')}}">All</a>
            <a class="nav-link {{Request::get('status') == 'diskon' ? 'aktif' : ''}}" href="{{route('bajus.index',['status' => 'diskon'])}}">Diskon</a>
            <a class="nav-link" href="#">Out Stock</a>
            <a class="nav-link {{Request::path() == 'bajus/trash' ? 'aktif' : ''}}" href="{{route('bajus.trash')}}">Trash</a>
        </div>
    </div>
            
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="{{route('bajus.create')}}" class="btn btn-primary">Tambah Baju</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><b>Name</b></th>
                        <th><b>Harga</b></th>
                        <th><b>Potongan</b></th>
                        <th><b>Gambar</b></th>
                        <th><b>Kategori</b></th>
                        <th><b>XL</b></th>
                        <th><b>L</b></th>
                        <th><b>M</b></th>
                        <th><b>S</b></th>
                        <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bajus as $baju)
                        <tr>
                        <td>{{$baju->nama_baju}}</td>
                        <td>{{"Rp " . number_format($baju->harga,0,',','.')}}</td>
                        <td>{{"Rp " . number_format($baju->diskon,0,',','.')}}</td>
                        <td>
                        <img  src="{{asset('storage/' . $baju->gambar1)}}"  width="48px" height="48px" > 
                        </td>
                        <td>
                            <ul class="pl-3">
                            @foreach($baju->kategori as $category)
                            <li>{{$category->name}}</li>  
                            @endforeach
                            </ul>
                        </td>
                            @foreach($baju->jumlah as $jumlahs)
                                <td>{{$jumlahs->jumlah}}</td>
                            @endforeach
                        <td>
                        <form  class="d-inline" action="{{route('bajus.destroy', ['id' => $baju->id])}}"  method="POST"
                        onsubmit="return confirm('Move category to trash?')">
                        @csrf 
                        <input  type="hidden"  value="DELETE"  name="_method">
                        <a href="{{route('bajus.show', ['id' => $baju->id])}}" class="btn btn-primary btn-sm mt-1">D</a>
                        <a href="{{route('bajus.edit', ['id' => $baju->id])}}" class="btn btn-info btn-sm mt-1"> E </a>
                        <input  type="submit"  class="btn btn-danger btn-sm mt-1"   value="T">
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

