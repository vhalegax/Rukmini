@extends('layouts.frontend')
@section('title') Belanjaan @endsection
@section('content')

        <div style="height:60px;">
            <div class="container">
            </div>
        </div>

        <section class="mt-5" style="min-height:600px;">
            <div class="container">

            <div class="profile-pembeli2">
                <a  href="{{route('pembeli.index')}}">Profil</a>
                <a  href="{{route('alamat.index',['status'=>'daftar'])}}" >Daftar Alamat</a>
                <a href="{{route('cart.index')}}"  >Keranjang Belanjaan</a>
                <a  href="{{route('checkout.index')}}">Pembayaran</a>
                <a  href="{{route('pembeli.wishlist')}}">Wishlist</a>
                <a class="active" href="{{route('pembeli.wishlist')}}">Riwayat Transaksi</a>
            </div>

            <div class="row border bingkai">
                <div class="col-12 col-md-12">
                
                    <div class="mb-3">
                        <h5><b>Datftar Riwayat Pembelian</b></h5>
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
                        <h6 class="card-title"><b>Status Pesaan : </b> Selesai </h6><h6 class="card-title"></h6>
                        <a class="btn btn-dark" href="{{route('checkout.show', ['id' => $orders->id])}}">Beli Lagi</a>
                        <a class="btn btn-outline-dark" href="{{route('checkout.show', ['id' => $orders->id])}}">Detail Pembelian</a>
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