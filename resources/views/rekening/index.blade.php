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

    <div class="card shadow mb-2 ">
        <div class="submenu">
            <a class="nav-link {{Request::path() == 'dashboard/rekening/tampil/aktif' ? 'aktif' : ''}}" href="{{route('rekening.tampil',['status' =>'aktif'])}}" >Aktif ({{$aktif}})</a>
            <a class="nav-link {{Request::path() == 'dashboard/rekening/tampil/nonaktif' ? 'aktif' : ''}}" href="{{route('rekening.tampil',['status' =>'nonaktif'])}}">Tidak Aktif ({{$nonaktif}})</a>
        </div>
    </div>
            
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="{{route('rekening.create')}}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah Rekening</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th width="20%"><b>Jenis Rekening</b></th>
                        <th width="15%"><b>Atas Nama</b></th>
                        <th width="20%"><b>Nomor</b></th>
                        <th width="20%"><b>Gambar</b></th>
                        <th width="10%"><b>Status</b></th>
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
                            <td>{{$rekening->status}}</td>
                            @if($rekening->status == 'aktif')
                            <td>
                                <a href="{{route('rekening.edit', ['id' => $rekening->id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{route('rekening.nonaktif', ['id' => $rekening->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Non Aktifkan Rekening?')"><i class="fas fa-ban"></i></a>
                            </td>
                            @else
                            <td>
                                <a href="{{route('rekening.aktif', ['id' => $rekening->id])}}" class="btn btn-info btn-sm" onclick="return confirm('Aktifkan Rekening Kembali?')"><i class="fas fa-power-off"></i></a>
                                <form  class="d-inline" action="{{route('rekening.destroy', ['id' => $rekening->id])}}" 
                                method="POST"  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Rekening Permanen?')" >
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

