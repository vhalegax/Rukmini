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
                <a  class="active" href="{{route('pembeli.index')}}">Profil</a>
                <a  href="{{route('alamat.index',['status'=>'daftar'])}}" >Daftar Alamat</a>
                <a  href="{{route('cart.index')}}"  >Keranjang Belanjaan</a>
                <a  href="{{route('checkout.index')}}">Pembayaran</a>
                <a  href="{{route('pembeli.wishlist')}}">Wishlist</a>
                <a  href="{{route('pembeli.history')}}">Riwayat Transaksi</a>
            </div>


            <div class="row border bingkai">
                <div class="col-12 col-md-12">
                
                    <div class="mb-3">
                        <h5><b>Profil Pembeli</b></h5>
                        <hr>
                    </div>

                    @if(session('status'))
                    <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('status')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                    </div>
                    @endif 
                    
                    <form enctype="multipart/form-data" 
                        action="{{route('pembeli.update',['id'=>$pembeli->id])}}" 
                        method="POST">
                        
                        @csrf

                        
                        <input type="hidden"  value="PUT"  name="_method">

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="first_name">Nama Lengkap : {{ $pembeli->nama_lengkap }}</label>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Nomor Telepon : -{{ $pembeli->telp }}</label>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email_address">Email Address : {{ $pembeli->email }}</label>
                            </div>
                        </div>
                            <button class="btn btn-dark"  type="submit" value="save">Ubah Profil</button>
                    </form>
                    </div>
                </div>
            </div>

            
        </div>
   
    </section>
    <!-- ##### Shop Grid Area End ##### -->

@endsection


