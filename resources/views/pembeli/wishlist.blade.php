@extends('layouts.frontend')
@section('title') Wishlist @endsection
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
                    <a class="active" href="{{route('pembeli.wishlist')}}">Wishlist</a>
                    <a href="{{route('pembeli.history')}}">Riwayat Transaksi</a>
                </div>

                <div class="row border bingkai">
                    <div class="col-12 col-md-12">

                    <div class="mb-3">
                        <h5><b>Datftar Wishlist</b></h5>
                    </div>

                        <table class="table">
                            <tbody>
                                <th></th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                                <?php foreach(Auth::guard('pembeli')->user()->Wishlist as $row) :?>
                                    <?php foreach($row->baju as $baju) :?>
                                        <tr>
                                            <td class="pt-5">
                                                <a class="btn btn-outline-danger" href="{{route('shop.hapuswishlist', ['id' => $baju->id, 'status'=> 'wishlist'])}}">X</a></td>
                                            <td>
                                                <img src="{{asset('storage/' . $baju->gambar1)}}" style=" height: 130px; width: 130px;">
                                            </td>
                                            <td class="pt-5"><h4><b>{{$baju->nama}}</b></h4></td>
                                            <td class="pt-5"><h4><b>Rp {{ number_format($baju->harga,0,",",".")}}</b></h4></td>
                                            <td class="pt-5">
                                                <a class="btn btn-outline-dark" href="{{route('shop.detail', ['id' => $baju->id])}}">Beli Sekarang</a>
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
        </section>

        @endsection
