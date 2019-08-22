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
                    <th>Pembeli</th>
                    <th>i</th>
                    <th>j</th>
                    <!-- <th>Baju_id</th> -->
                    <th>Simalirty</th> 
                </thead>
                <tbody>
                
                @foreach ($baju_i as $baju_ii)

                    @php $i = $baju_ii->id; $nama_i = $baju_ii->nama_baju;  @endphp

                        @foreach($baju_j as $baju_jj)

                            @php $atas=0; $kiri=0; $kanan=0; @endphp

                            @if($baju_jj->id != $i)

                                @php $j = $baju_jj->id; $nama_j = $baju_jj->nama_baju; @endphp

                                    @foreach($pembeli as $id_pembeli => $pembeli_id)

                                        @php $temp=0; $avg=$pembeli_id->avg('rating');  $Rai=0; $Rab=0; @endphp

                                        @foreach($pembeli_id as $pembeli_ids)

                                            @if($pembeli_ids->baju_id==$i)
                                                
                                                @php $Rai= $pembeli_ids->rating-$avg; @endphp
                                                @php $temp = $temp+1; @endphp

                                            @elseif($pembeli_ids->baju_id==$j)

                                                @php $Rab= $pembeli_ids->rating-$avg; @endphp
                                                @php $temp = $temp+1; @endphp

                                            @endif

                                            @if($Rai!=0 && $Rab!=0)
                                                @php $atas=$atas+1; @endphp
                                                @php $kiri=$kiri+1; @endphp
                                                @php $kanan=$kanan+1; @endphp
                                            @endif

                                        @endforeach

                                        @if($temp==2)
                                        <tr>
                                            <th>{{$i}}</th>
                                            <th>{{$j}}</th>
                                            <th>{{$atas}}/{{$kiri}}*{{$kanan}}</th>
                                            <th>{{$id_pembeli}}</th>
                                        </tr>
                                        @endif

                                    @endforeach

                            @endif

                        @endforeach

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



                        