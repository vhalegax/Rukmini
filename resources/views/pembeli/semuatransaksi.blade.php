@extends('layouts.frontend')
@section('title') Belanjaan @endsection

@section('css')
  <link rel="stylesheet" href="{{asset('frontend/css/suggest-item.css')}}">
@endsection

@section('content')

<div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
        <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>Pembayaran</h2>
                    </div>
                </div>
            </div>
        </div>

    <section class="mt-5">
        <div class="container">

            <div class="profile-pembeli2">
                <a  href="{{route('pembeli.index')}}">Profile</a>
                <a  href="{{route('alamat.index',['status'=>'daftar'])}}" >Daftar Alamat</a>
                <a href="{{route('cart.index')}}"  >Keranjang Belanjaan</a>
                <a class="active" href="{{route('checkout.index')}}">Pembayaran</a>
                <a href="{{route('pembeli.wishlist')}}">Wishlist</a>
                <a href="{{route('pembeli.wishlist')}}">Riwayat Transaksi</a>
            </div>

            <div class="row border bingkai">
                <div class="col-12 col-md-12">

                    <div class="menu-pembayaran mb-1">
                        <a class="active" href="">Semua</a>
                        <a href="#home">Belum Dibayar</a>
                        <a href="#news">Menunggu Konfirmasi</a>
                        <a href="#contact">Sedang Diproses</a>
                        <a href="#about">Pengiriman</a>
                    </div>

                    <hr>

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
                    @if($orders->status !== 'Selesai')
                    <div class="card pembayaran">
                        <h5 class="card-header">#{{$orders->invoice_number}}</h5>
                        <div class="card-body">
                        <p class="card-title"><b>Tanggal Pesan : </b> {{date('d M Y ',strtotime($orders->created_at))}}</p> 
                        <p class="card-title"><b>Total Belanja : </b> Rp <?php echo number_format(($orders->total)-($orders->potongankupon), 2, ",", "."); ?> </p>
                        <p class="card-title"><b>Status : </b>{{$orders->status}} </p>
                        
                        @if($orders->status === 'Menunggu Konfirmasi')
                            <p >Pembayaran Berhasil Dilakukan, Menunggu Konfirmasi</p>
                            <form  class="d-inline"
                                action="{{route('checkout.destroy', ['id' => $orders->id])}}" method="POST"
                                onsubmit="return confirm('Batalkan Pesanan?')">
                                @csrf 
                                <input  type="hidden"  value="DELETE"  name="_method">
                                <button type="button" class="btn btn-outline-secondary btn-sm"><a href="{{route('pembeli.konfirmasi',['id'=>$orders->id])}}">Ubah</a></button>
                                <button class="btn btn-outline-secondary btn-sm" type="submit" value="save"><a href="{{route('checkout.show', ['id' => $orders->id])}}">Detail</a></button>
                                <input  type="submit"  class="btn btn-outline-secondary btn-sm" value="Batalkan">
                            </form>
                       
                        @elseif($orders->status === 'Proses')
                            <p class="card-text">Pembayaran Berhasil Dikonfirmasi, Menunggu Pengiriman</p>
                            <form method="POST" enctype="multipart/form-data" action="{{route('checkout.update', ['id' => $orders->id])}}">
                                    @csrf
                                        <input type="hidden"  value="PUT"  name="_method">
                                        <input type="hidden"  value="Selesai"  name="selesai">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm" value="save">Selesai</button>
                                        <button class="btn btn-outline-secondary btn-sm" type="submit" value="save"><a href="{{route('checkout.show', ['id' => $orders->id])}}">Detail</a></button>
                                        <button class="btn btn-outline-secondary btn-sm" >Komplain</button>
                            </form>
                       
                        @elseif($orders->status === 'Pengiriman')
                            <p class="card-text">Pembelian Dalam Proses Pengiriman</p>
                            <form method="POST" enctype="multipart/form-data" action="{{route('checkout.update', ['id' => $orders->id])}}">
                                    @csrf
                                        <input type="hidden"  value="PUT"  name="_method">
                                        <input type="hidden"  value="Selesai"  name="selesai">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm" value="save">Selesai</button>
                                        <button class="btn btn-outline-secondary btn-sm" type="submit" value="save"><a href="{{route('checkout.show', ['id' => $orders->id])}}">Detail</a></button>
                                        <button class="btn btn-outline-secondary btn-sm" >Komplain</button>
                            </form>
                       
                        @else
                            <p class="card-text">Pembelian Berhasil, Silahkan Lakukan Pembayaran</p>
                            <p class="card-text">*Batal Otomatis Dalam 2 Hari</p>
                            <form  class="d-inline"
                                action="{{route('checkout.destroy', ['id' => $orders->id])}}" method="POST"
                                onsubmit="return confirm('Batalkan Pesanan?')">
                                @csrf 
                                <input  type="hidden"  value="DELETE"  name="_method">
                                <button type="button" class="btn btn-outline-secondary btn-sm"><a href="{{route('pembeli.konfirmasi',['id'=>$orders->id])}}">Konfirmasi</a></button>
                                <button class="btn btn-outline-secondary btn-sm" type="submit" value="save"><a href="{{route('checkout.show', ['id' => $orders->id])}}">Detail</a></button>
                                <input  type="submit"  class="btn btn-outline-secondary btn-sm" value="Batalkan">
                            </form>
                        @endif
                            
                           
                        </div>
                    </div>
                    <br>
                    @endif
                    <?php endforeach;?>


                    </div>
                </div>
            </div>
        </div> 
    </section>
    <!-- ##### Shop Grid Area End ##### -->

@endsection

@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/time.js') }}"></script>

@endsection