@extends('layouts.frontend')
@section('title') Belanjaan @endsection
@section('content')

    <div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
        <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>Profile</h2>
                    </div>
                </div>
            </div>
        </div>

    <section class="mt-5">
        <div class="container">

            <div class="profile-pembeli2">
                <a class="active" href="{{route('pembeli.index')}}">Profile</a>
                <a  href="{{route('alamat.index',['status'=>'daftar'])}}" >Daftar Alamat</a>
                <a href="{{route('cart.index')}}"  >Keranjang Belanjaan</a>
                <a  href="{{route('checkout.index')}}">Pembayaran</a>
                <a  href="{{route('pembeli.wishlist')}}">Wishlist</a>
                <a href="{{route('pembeli.wishlist')}}">Riwayat Transaksi</a>
            </div>


            <div class="row border bingkai">
                <div class="col-12 col-md-12">
                
                    <div class="mb-3">
                        <h5>Profile Pembeli</h5>
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
                                <label for="first_name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $pembeli->nama_lengkap }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Phone No</label>
                                <input type="number" class="form-control" id="telp" name="telp" min="0" value="{{ $pembeli->telp }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email_address">Email Address</label>
                                <input disabled type="email" class="form-control" id="email" name="email" value="{{ $pembeli->email }}">
                            </div>
                        </div>
                                <br>
                            <button class="btn btn-outline-secondary"  type="submit" value="save">Simpan</button>
                    </form>
                    </div>
                </div>
            </div>

            
        </div>
   
    </section>
    <!-- ##### Shop Grid Area End ##### -->

@endsection


