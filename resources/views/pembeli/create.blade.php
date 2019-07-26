@extends('layouts.frontend')
@section('title') Daftar @endsection
@section('content')

<div class="breadcumb_area bg-img" style="background-image: url({{asset('front-wisnu/img/breadcumb.jpg')}});">
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


    <!-- ##### Checkout Area End ##### -->


@endsection
