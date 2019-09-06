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
        
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="input-group-append">
            <a href="{{route('kupon.create')}}" class="btn btn-primary">Tambah Kupon</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th width="15%"><b>Nama Kupon</b></th>
                    <th width="22%"><b>Deskripsi</b></th>
                    <th width="10%"><b>Kode Kupon</b></th>
                    <th width="10%"><b>Potongan</b></th>
                    <th width="15%"><b>Minimal Pembelian</b></th>
                    <th width="10%"><b>Masa Berlaku</b></th>
                    <th width="5%"><b>Jumlah</b></th>
                    <th width="10%"><b>Aksi</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kupon as $kupon)
                    <tr>
                        <td>{{$kupon->nama}}</td>
                        <td>{!!$kupon->deskripsi!!}</td>
                        <td>{{$kupon->kode}}</td>
                        <td>Rp {{number_format("$kupon->potongan",0,",",".")}}</td>
                        <td>Rp {{number_format("$kupon->minimalpembelian",0,",",".")}}</td>
                        <td>{{$kupon->masa_berlaku}}</td>
                        <td>{{$kupon->jumlah}}</td>
                        <td>
                            <a href="{{route('kupon.edit', ['id' => $kupon->id])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <form  class="d-inline" action="{{route('kupon.destroy', ['id' => $kupon->id])}}" 
                            method="POST" onsubmit="return confirm('Hapus Kupon?')">
                            @csrf 
                            <input type="hidden"  value="DELETE"  name="_method">
                            <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
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

