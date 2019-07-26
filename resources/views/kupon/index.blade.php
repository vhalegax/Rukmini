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
            <a href="{{route('kupon.create')}}" class="btn btn-primary btn-sm">Tambah Kupon</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th><b>#</b></th>
                    <th><b>Nama Kupon</b></th>
                    <th><b>Deskripsi</b></th>
                    <th><b>Kode Kupon</b></th>
                    <th><b>Potongan</b></th>
                    <th><b>Minimal Pembelian</b></th>
                    <th><b>Masa Berlaku</b></th>
                    <th><b>Jumlah</b></th>
                    <th><b>Aksi</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kupon as $kupon)
                    <tr>
                        <td>{{$kupon->id}}</td>
                        <td>{{$kupon->nama_kupon}}</td>
                        <td>{{$kupon->deskripsi}}</td>
                        <td>{{$kupon->kode_kupon}}</td>
                        <td>{{$kupon->potongan}}</td>
                        <td>{{$kupon->minimalpembelian}}</td>
                        <td>{{$kupon->masa_berlaku}}</td>
                        <td>{{$kupon->jumlah}}</td>
                        <td>
                        <form  class="d-inline" action="{{route('kupon.destroy', ['id' => $kupon->id])}}" 
                        method="POST" onsubmit="return confirm('Hapus Kupon?')">
                        @csrf 
                        <input type="hidden"  value="DELETE"  name="_method">
                        <a href="{{route('kupon.edit', ['id' => $kupon->id])}}" class="btn btn-info btn-sm mt-1"> Edit </a>
                        <input  type="submit"  class="btn btn-danger btn-sm mt-1"  value="Hapus">
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

