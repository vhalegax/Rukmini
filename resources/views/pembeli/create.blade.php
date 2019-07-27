@extends('layouts.frontend')

@section('title') Daftar Pembeli @endsection

@section('css')
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="container" style="margin-top:100px;">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                       <form class="user" enctype="multipart/form-data"  action="{{route('pembeli.store')}}"  method="POST">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"  id="first_name" name="first_name" value="" required placeholder="First Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user"  id="last_name" name="last_name" value="" required placeholder="Last Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" value="" placeholder="Email Address">
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" value="" placeholder="Password">
                                </div>

                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" disabled>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-user btn-block" type="submit" value="save">Daftar</button>
                            <hr>

                            <a href="index.html" class="btn btn-google btn-user btn-block"  style="color:#FFFFFF">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>

                            <a href="index.html" class="btn btn-facebook btn-user btn-block"  style="color:#FFFFFF">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>

                        </form>

                        <hr>
                        <br>
                        <div class="text-center">
                            <a class="small" href="{{route('pembeli.login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Daftar Lama -->

<!-- <div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
        <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>Register Buyer</h2>
                    </div>
                </div>
            </div>
        </div>


<div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 border bingkai">

                        <div class="mb-3">
                            <h5>Isi Form Pendaftaran</h5>
                        </div>

                        <form enctype="multipart/form-data" 
                            action="{{route('pembeli.store')}}" 
                            method="POST">
                            
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name <span>*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="company">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="company">Confirm Password</label>
                                    <input type="text" class="form-control" id="company" value="" disabled>
                                </div>
                               
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Terms and conitions</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Subscribe to our newsletter</label>
                                    </div>
                                </div>
                            </div>
                                    <br>
                                 <button class="btn btn-outline-secondary"  type="submit" value="save">Daftar</button>
                                 <br><br>
                                 Already Have Account? <a href="{{route('pembeli.login')}}">Login Here</a>
                        </form>
                </div>

            </div>
        </div>
    </div>
 -->

@endsection
