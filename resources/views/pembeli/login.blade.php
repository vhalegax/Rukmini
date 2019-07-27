@extends('layouts.frontend')

@section('title') Login Pembeli @endsection

@section('css')
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="container" style="margin-top:50px;">

    <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('pembeli.login.post') }}">
                                        {{ csrf_field() }}  
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" required autofocus id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"  id="password"  name="password" placeholder="Password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Masuk
                                        </button>

                                        <hr>

                                        <a href="index.html" class="btn btn-google btn-user btn-block" style="color:#FFFFFF">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>

                                        <a href="index.html" class="btn btn-facebook btn-user btn-block" style="color:#FFFFFF">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                        
                                    </form>

                                    <hr>
                                        <div class="text-center">
                                            <a class="small" href="">Forgot Password?</a>
                                        </div>

                                        <div class="text-center">
                                            <a class="small" href="{{route('pembeli.create')}}">Create an Account!</a>
                                        </div>
                                </div>
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
