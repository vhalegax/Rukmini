@extends('layouts.frontend')
@section('title') Rukmini @endsection
@section('content')
<section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top:70px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active gambargerak">
            <img class="d-block w-100" src="{{asset('front-wisnu/img/1.jpg')}}" style="height:100%; width:100%;" alt="First slide">
            </div>
            <div class="carousel-item gambargerak">
            <img class="d-block w-100" src="{{asset('front-wisnu/img/2.jpg')}}" style="height:100%; width:100%;" alt="Second slide">
            </div>
            <div class="carousel-item gambargerak">
            <img class="d-block w-100" src="{{asset('front-wisnu/img/3.jpg')}}"  style="height:100%; width:100%;" alt="Thrid slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="homeinfo">
        <div class="container">
            <div class="row pt-5">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center pb-5" style="height:300px;">
                    <img src="{{asset('front-wisnu/img/fit-guide.png')}}" alt="" height="90px" width="90px">
                    <h5 class="mt-2 mb-2">PANDUAN UKURAN</h5>
                    <p>Tidak Tahu Ukuran Pakaian Yang Cocok?</p>
                    <button class="btn btn-outline-secondary">CEK UKURANMU DISINI</button>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center pb-5" style="height:300px;">
                    <img src="{{asset('front-wisnu/img/easy-return.png')}}" alt="" height="90px" width="90px">
                    <h5 class="mt-2 mb-2">BISA TUKAR</h5>
                    <p>Salah Ukuran? Tukar Saja</p>
                    <button class="btn btn-outline-secondary">PERSYARATAN TUKAR</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <div style="height:450px; background-color:grey;">
        <center><h1 style="padding-top:200px;">Produk On Sale</h1></center>
    </div> -->
</section>
@endsection