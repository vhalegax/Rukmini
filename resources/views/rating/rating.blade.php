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
        <a class="nav-link {{Request::path() == 'karyawan/rating/rating' ? 'aktif' : ''}}" href="{{route('rating.rating')}}">Avg Rating</a>
        <a class="nav-link {{Request::path() == 'karyawan/rating/similarity' ? 'aktif' : ''}}" href="{{route('rating.similarity')}}">Similarity</a>
        <a class="nav-link" href="#">Rekomendasi</a>
    </div>
</div>

        
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="input-group-append">
            <h4>Avg Rating Dari Pembeli</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Id Pembeli</th>
                    <th>Avg Rating</th>
                </thead>
                <tbody>
                        @foreach ($rating as $pembeli => $ratings)
                            <tr>
                            <th>{{$pembeli}}</th>
                            <th>{{$ratings->avg('rating')}}</th>
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