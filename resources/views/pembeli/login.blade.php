@extends('layouts.frontend')

@section('title') Login Pembeli @endsection

@section('css')
    <link rel="stylesheet" href="{{asset('frontend/css/loginpembeli.css')}}">
@endsection

@section('content')

    <div class="container" style="margin-top:120px;">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6" style="min-height:600px">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('pembeli.login.post') }}">
                                {{ csrf_field() }}  
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" required autofocus id="email" aria-describedby="emailHelp" placeholder="Masukkan Alamat Email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"  id="password"  name="password" placeholder="Masukkan Password" required> 
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label text-sm" for="customCheck">Remember Me</label>
                                    </div>
                                </div> -->

                                <button type="submit" class="btn btn-dark btn-user btn-block">
                                        Login
                                </button>

                                <hr>

                                <a href="index.html" class="btn btn-google btn-user btn-block" style="color:#FFFFFF">
                                    <i class="fab fa-google fa-fw"></i> Login Dengan Google
                                </a>

                                <a href="index.html" class="btn btn-facebook btn-user btn-block" style="color:#FFFFFF">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login Dengan Facebook
                                </a>
                                
                            </form>

                            <hr>
                                <div class="text-center">
                                    <a  href="{{route('pembeli.lupapass')}}">Lupa Password ?</a>
                                </div>

                                <div class="text-center">
                                    <a href="{{route('pembeli.create')}}">Buat Akun !</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Lama -->

    <!-- <div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
        <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>Selamat Datang</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
                <div class="row  border bingkai">
                    <div class="col-12 ">
                    <form class="form-horizontal" method="POST" action="{{ route('pembeli.login.post') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">E-Mail</label>

                            <div class="col-md-12">
                                <input placeholder="Masukkan alamat email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Password</label>

                            <div class="col-md-12">
                                <input placeholder="Masukkan password" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-primary btn-block">
                                    Masuk
                                </button>
                            </div>
                        </div>

                          <hr>

                            <div class="col-md-12">
                                 <button type="submit" class="btn btn-outline-primary btn-block"> Masuk Dengan Facebook </button>
                            </div>
                            <div class="col-md-12 mt-2">
                                 <button type="submit" class="btn btn-outline-danger btn-block"> Masuk Dengan Google </button>
                            </div>

                        <hr>

                          <div class="col-md-12 text-center">
                                <a href="{{route('pembeli.create')}}">Lupa Password?</a><br>
                                <a href="{{route('pembeli.create')}}">Buat Akun Baru!</a>
                            </div>
                           
                            
                           
                        </div>
                    </form>
                 </div>
             </div>
          </div> -->


@endsection
