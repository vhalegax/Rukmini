@extends('layouts.frontend')
@section('title') Wishlist @endsection
@section('content')

        <div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
            <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>Wishlist</h2>
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
                    <a  href="{{route('checkout.index')}}">Pembayaran</a>
                    <a class="active" href="{{route('pembeli.wishlist')}}">Wishlist</a>
                    <a href="{{route('pembeli.wishlist')}}">Riwayat Transaksi</a>
                </div>

                <div class="row border bingkai">
                    <div class="col-12 col-md-12">

                    <div class="mb-3">
                        <h5>Datftar Wishlist</h5>
                        <hr>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <?php foreach(Auth::guard('pembeli')->user()->Wishlist as $row) :?>
                                    <?php foreach($row->baju as $baju) :?>
                                        <tr>
                                            <td style="width:150px;">
                                            <img src="{{asset('storage/' . $baju->gambar1)}}" style=" height: 150px; width: 150px;"></td>
                                            <td style="width:500px;">
                                                    <b>{{$baju->nama_baju}}</b><br class="mb-3">
                                                    <b>Rp {{$baju->harga}}</b><br class="mb-3">
                                                    <button class="btn btn-outline-secondary btn-sm mt-2 mb-1"> 
                                                        <a href="{{route('shop.detail', ['id' => $baju->id])}}">Beli Sekarang</a>
                                                    </button><br>
                                                    <button class="btn btn-outline-danger btn-sm"> 
                                                        <a href="{{route('shop.hapuswishlist', ['id' => $baju->id, 'status'=> 'wishlist'])}}">Hapus Wishlist</a>
                                                    </button>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endforeach;?>
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <td colspan="8">&nbsp;</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                </div>
        </section>

        @endsection
