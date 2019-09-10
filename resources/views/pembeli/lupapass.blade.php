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
                <div class="col-lg-6 d-none d-lg-block bg-password-image rounded-left"></div>
                <div class="col-lg-6" style="min-height:600px">
                    <div class="p-5">
                        <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Lupa Password</h1>
                        </div>
                        <form class="user" enctype="multipart/form-data"  action="{{route('pembeli.store')}}"  method="POST">
                            @csrf

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" value="" placeholder="Alamat Email">
                            </div>

                            <button class="btn btn-dark btn-user btn-block" type="submit" value="save">Reset Password</button>
                            <hr>
                        </form>
                        <br>
                        <div class="text-center">
                           <a href="{{route('pembeli.create')}}"> Buat Akun !</a><br>
                            Sudah Punya Akun ? <a href="{{route('pembeli.login')}}"> Login !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
