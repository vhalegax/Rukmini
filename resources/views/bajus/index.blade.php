@extends("layouts.dashboard")

@section("title") Daftar Pakaian @endsection 

@section('pageTitle') Daftar Pakaian @endsection

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
            <a class="nav-link {{Request::path() == 'dashboard/pakaian/tampil/aktif' ? 'aktif' : ''}}" href="{{route('pakaian.tampil',['status' =>'aktif'])}}">Aktif ({{$aktif}})</a>
            <a class="nav-link {{Request::path() == 'dashboard/pakaian/tampil/diskon' ? 'aktif' : ''}}" href="{{route('pakaian.tampil',['status' =>'diskon'])}}">Pakaian Diskon ({{$diskon}})</a>
            <a class="nav-link {{Request::path() == 'dashboard/pakaian/tampil/nonaktif' ? 'aktif' : ''}}" href="{{route('pakaian.tampil',['status' =>'nonaktif'])}}">Tidak Aktif ({{$nonaktif}})</a>
        </div>
    </div>
            
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="{{route('pakaian.create')}}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah Pakaian</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th width="3%"><b>#</b></th>
                        <th width="20%"><b>Nama</b></th>
                        <th width="10%"><b>Harga</b></th>
                        <th width="10%"><b>Diskon</b></th>
                        <th width="10%"><b>Gambar</b></th>
                        <th width="15%"><b>Kategori</b></th>
                        <th width="5%"><b>XL</b></th>
                        <th width="5%"><b>L</b></th>
                        <th width="5%"><b>M</b></th>
                        <th width="5%"><b>S</b></th>
                        <th width="15%"><b>Aksi</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bajus as $baju)
                        <tr>
                        <td>{{$baju->id}}</td>
                        <td>{{$baju->nama}}</td>
                        <td>{{"Rp " . number_format($baju->harga,0,',','.')}}</td>
                        <td>{{"Rp " . number_format($baju->diskon,0,',','.')}}</td>
                        <td>
                        <img  src="{{asset('storage/' . $baju->gambar1)}}"  width="48px" height="48px" > 
                        </td>
                        <td>
                            <ul class="pl-3">
                            @foreach($baju->kategori as $kategori)
                            <li>{{$kategori->nama}}</li>  
                            @endforeach
                            </ul>
                        </td>
                        @foreach($baju->jumlah as $jumlahs)
                            <td>{{$jumlahs->jumlah}}</td>
                        @endforeach
                        
                        @if($baju->status == 'aktif')
                            <td>
                                <a href="{{route('pakaian.show', ['id' => $baju->id])}}" class="btn btn-primary btn-sm mt-1"><i class="fas fa-eye"></i></a>
                                <a href="{{route('pakaian.edit', ['id' => $baju->id])}}" class="btn btn-info btn-sm mt-1"><i class="fas fa-edit"></i></a>
                                <a href="{{route('pakaian.nonaktif', ['id' => $baju->id])}}" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Non Aktifkan Pakaian?')"><i class="fas fa-ban"></i></a>
                            </td>
                        @else
                            <td>
                                <a href="{{route('pakaian.aktif', ['id' => $baju->id])}}" class="btn btn-info btn-sm" onclick="return confirm('Aktifkan Pakaian Kembali?')"><i class="fas fa-power-off"></i></a>
                                <form  class="d-inline" action="{{route('pakaian.destroy', ['id' => $baju->id])}}" 
                                method="POST"  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Pakaian Permanen?')" >
                                @csrf 
                                <input type="hidden"name="_method" value="DELETE"/>
                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i> </button>
                                </form>    
                            </td>

                        @endif
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection