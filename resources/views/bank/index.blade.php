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
                <a href="{{route('bank.create')}}" class="btn btn-primary">Tambah No Rekening Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><b>Nama Bank</b></th>
                        <th><b>Atas Nama</b></th>
                        <th><b>No Rekening</b></th>
                        <th><b>Logo</b></th>
                        <th><b>Aksi</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bank as $bank)
                        <tr>
                            <td>{{$bank->nama_bank}}</td>
                            <td>{{$bank->AtasNama}}</td>
                            <td>{{$bank->NoRek}}</td>
                            <td>
                            @if($bank->img)
                                <img 
                                src="{{asset('storage/' . $bank->img)}}" 
                                width="48px"/>
                            @else 
                                No image
                            @endif
                            </td>
                            <td>
                                <form  class="d-inline" action="{{route('bank.destroy', ['id' => $bank->id])}}" 
                                method="POST" onsubmit="return confirm('Hapus No Rekening Bank?')">
                                @csrf 
                                <input type="hidden"  value="DELETE"  name="_method">
                                <a href="{{route('bank.edit', ['id' => $bank->id])}}" class="btn btn-info btn-sm mt-1"> Edit </a>
                                <input  type="submit"  class="btn btn-danger btn-sm mt-1"  value="Hapus">
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

