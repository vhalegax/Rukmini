@extends('layouts.frontend')

@section('title') Daftar Pembeli @endsection

@section('css')
    <link rel="stylesheet" href="{{asset('frontend/css/loginpembeli.css')}}">
@endsection

@section('content')

<div class="container" style="margin-top:120px;">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image rounded-left"></div>
                <div class="col-lg-7" style="min-height:600px">
                    <div class="p-5">
                        <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
                        </div>
                        <form class="user" enctype="multipart/form-data"  action="{{route('pembeli.store')}}"  method="POST">
                            @csrf

                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user"  name="nama" value="" required placeholder="Nama Lengkap">
                            </div>

                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user"  name="nomor" value="" required placeholder="Nomor Telepon">
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" value="" placeholder="Alamat Email">
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" value="" placeholder="Password">
                                </div>

                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Konfirmasi password">
                                </div>
                            </div>

                            <button class="btn btn-dark btn-user btn-block" type="submit" value="save">Daftar</button>
                            <hr>
                        </form>
                        <br>
                        <div class="text-center">
                            <a href="{{route('pembeli.lupapass')}}"> Lupa Password ?</a><br>
                            Sudah Punya Akun ? <a href="{{route('pembeli.login')}}"> Login !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
