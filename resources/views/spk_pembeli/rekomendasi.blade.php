@extends("layouts.dashboard")

@section("title") Rekomendasi Produk @endsection 

@section('pageTitle') Rekomendasi Produk @endsection

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
            <h5>Rekomendasi Produk Untuk Pembeli {{$id}}</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Produk ID</th>
                    <th>Nama Produk</th>
                    <th>Nilai Rekomendasi</th>
                </thead>
                <tbody>
                 <tr>
                    <th>7</th>
                    <th>Pakaian 7</th>
                    <th>5</th>
                </tr>
                <tr>
                    <th>3</th>
                    <th>Pakaian 3</th>
                    <th>4.5612</th>
                </tr>
                <tr>
                    <th>2</th>
                    <th>Pakaian 2</th>
                    <th>4.4121</th>
                </tr>
                <tr>
                    <th>5</th>
                    <th>Pakaian 5</th>
                    <th>4.3123</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Pakaian 1</th>
                    <th>3.7421</th>
                </tr>

                    @for($i = 0; $i < count($rekomendasi); $i++) 
                        <tr>
                            <th>{{$rekomendasi[$i]['0']}}</th>
                            <th>{{$rekomendasi[$i]['1']}}</th>
                            <th>{{$rekomendasi[$i]['2']}}</th>
                        </tr>
                    @endfor

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



                        