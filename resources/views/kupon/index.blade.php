@extends("layouts.dashboard")

@section("title") Daftar Kupon @endsection 

@section('pageTitle') Daftar Kupon @endsection

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
        <a class="nav-link {{Request::path() == 'dashboard/kupon/tampil/aktif' ? 'aktif' : ''}}" href="{{route('kupon.tampil',['status' =>'aktif'])}}" >Aktif ({{$aktif}})</a>
        <a class="nav-link {{Request::path() == 'dashboard/kupon/tampil/nonaktif' ? 'aktif' : ''}}" href="{{route('kupon.tampil',['status' =>'nonaktif'])}}">Tidak Aktif ({{$nonaktif}})</a>
    </div>
</div>
        
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="input-group-append">
            <a href="{{route('kupon.create')}}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah Kupon</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th width="15%"><b>Nama Kupon</b></th>
                    <th width="15%"><b>Deskripsi</b></th>
                    <th width="10%"><b>Kode Kupon</b></th>
                    <th width="10%"><b>Potongan</b></th>
                    <th width="10%"><b>Minimal Pembelian</b></th>
                    <th width="15%"><b>Masa Berlaku</b></th>
                    <th width="8%"><b>Jumlah</b></th>
                    <th width="15%"><b>Aksi</b></th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$kupon->isEmpty())
                    @foreach ($kupon as $kupon)
                    <tr>
                        <td>{{$kupon->nama}}</td>
                        <td>{!!$kupon->deskripsi!!}</td>
                        <td>{{$kupon->kode}}</td>
                        <td>Rp {{number_format("$kupon->potongan",0,",",".")}}</td>
                        <td>Rp {{number_format("$kupon->minimalpembelian",0,",",".")}}</td>
                        <td>{{$kupon->masa_berlaku}}</td>
                        <td>{{$kupon->jumlah}}</td>
                        @if($kupon->status == 'aktif')
                        <td>
                            <a href="{{route('kupon.edit', ['id' => $kupon->id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="{{route('kupon.nonaktif', ['id' => $kupon->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Non Aktifkan Kupon?')"><i class="fas fa-ban"></i></a>
                        </td>
                        @else
                        <td>
                            <a href="{{route('kupon.aktif', ['id' => $kupon->id])}}" class="btn btn-info btn-sm" onclick="return confirm('Aktifkan Kupon Kembali?')"><i class="fas fa-power-off"></i></a>
                            <form  class="d-inline" action="{{route('kupon.destroy', ['id' => $kupon->id])}}" 
                            method="POST"  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Kupon Permanen?')" >
                            @csrf 
                            <input type="hidden"name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i> </button>
                            </form>    
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>   

@endsection

