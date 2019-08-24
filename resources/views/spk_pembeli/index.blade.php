@extends("layouts.dashboard")

@section("title") Data Pembeli @endsection 

@section('pageTitle') Data Pembeli @endsection

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
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Terakhir Online</th>
                    <th>AVG Rating</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                        @foreach ($pembeli as $pembeli)
                            <tr>
                            <th>{{$pembeli->id}}</th>
                            <th>{{$pembeli->nama_lengkap}}</th>
                            <th>{{$pembeli->email}}</th>
                            <th>{{$pembeli->last_online}}</th>
                            <th>{{$pembeli->Rating->avg('rating')}}</th>
                            <th><a href="{{route('spkpembeli.similarity', ['id' => $pembeli->id])}}" class="btn btn-primary btn-sm">Similarity</a>
                                <a href="{{route('spkpembeli.rekomendasi', ['id' => $pembeli->id])}}" class="btn btn-primary btn-sm">Rekomendasi</a>
                            </th>
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

<!-- 

   
 -->