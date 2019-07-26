@extends('layouts.frontend')
@section('title') Belanjaan @endsection
@section('content')

<div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
        <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>History Pembelian</h2>
                    </div>
                </div>
            </div>
        </div>

    <section class="mt-5">
        <div class="container">

                <div class="row mb-3 mt-5">
                    <div class="col-12 col-md-12 col-lg-12">
                         <ul class="nav pembeli nav-tabs justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('pembeli.index')}}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('alamat.index',['status'=>'daftar'])}}">Alamat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('cart.index')}}">Belanjaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('checkout.index')}}">Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('pembeli.wishlist')}}">Wishlist</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('pembeli.history')}}">History</a>
                            </li>
                        </ul>
                    </div>
                </div>

            <div class="row border bingkai">
                <div class="col-12 col-md-12">
                
                    <div class="mb-3">
                        <h5>Datftar History Pembelian</h5>
                        <hr>
                    </div>

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
                    
                    <?php foreach($order as $orders) :?>
                    <div class="card">
                        <h5 class="card-header">#{{$orders->invoice_number}}</h5>
                        <div class="card-body">
                        <h6 class="card-title"><b>Tanggal Pesan : </b> {{date('d M Y H:i:s',strtotime($orders->created_at))}} </h6><h6 class="card-title"></h6>
                        <h6 class="card-title"><b>Total Belanja : </b> Rp <?php echo number_format($orders->total, 2, ",", "."); ?> </h6><h6 class="card-title"></h6>
                        <h6 class="card-title"><b>Status Pesaan : </b> {{$orders->status}} </h6><h6 class="card-title"></h6>
                        <button class="btn btn-outline-secondary btn-sm" type="submit" value="save"><a href="{{route('checkout.show', ['id' => $orders->id])}}">Detail</a></button>
                        </div>
                    </div>
                    <br>
                    <?php endforeach;?>


                    </div>
                </div>
            </div>
        </div> 
    </section>

@endsection

@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/time.js') }}"></script>

@endsection