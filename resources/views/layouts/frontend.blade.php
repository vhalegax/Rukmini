<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/tampilbelanjaan.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nama.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Library -->

    @yield('css')

    <title>@yield('title')</title>

  </head>
  <body>
      <header>
            <nav class="navbar navbar-expand-lg navbar-light fixed-top navutama pt-0 pb-0">
                <div class="container">
                  <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('frontend/img/rukmini.jpg')}}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item">
                            <a class="nav-link {{Request::path() == '/' ? 'nav-active' : ''}}" href="{{route('home')}}">Beranda</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link {{Request::path() == 'shop' ? 'nav-active' : ''}}" href="{{route('tampil')}}">Produk</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Ukuran</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Kontak</a>
                          </li>
                        </ul>

                        <ul class="navbar-nav navbar-right">
                            @if(Auth::guard('pembeli')->user())
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" 
                                aria-haspopup="true" aria-expanded="false" href="{{route('pembeli.index')}}">
                                {{Auth::guard('pembeli')->user()->nama_lengkap}}</a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{route('pembeli.index')}}">Profile Pembeli</a>
                                  <a class="dropdown-item" href="{{route('alamat.index',['status'=>'daftar'])}}">Daftar Alamat</a>
                                  <a class="dropdown-item" href="{{route('cart.index')}}">Belanjaan</a>
                                  <a class="dropdown-item" href="{{route('checkout.index')}}">Pembayaran</a>
                                  <a class="dropdown-item" href="#">Wishlist</a>
                                  <a class="dropdown-item" href="#">History Pembelian</a>
                                  <a class="dropdown-item" href="{{ route('pembeli.logout') }}" 
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                              
                                  <form id="logout-form" action="{{ route('pembeli.logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  </form>
                                </div>
                              </li>

                            @elseif(\Auth::user())
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" 
                                aria-haspopup="true" aria-expanded="false" href="{{route('dashboard')}}">
                                {{Auth::user()->name}}</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a>
                                  <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                  </form>
                                </div>
                              </li>

                              @else
                              <li class="nav-item">
                                <a class="nav-link {{Request::path() == 'pembeli/login' ? 'nav-active' : ''}}" href="{{route('pembeli.login')}}">Login</a>
                              </li>
                              @endif     

                              @if(Auth::user())
                              @else
                              <li class="nav-item">
                                  <a class="nav-link {{Request::path() == 'cart' ? 'nav-active' : ''}}" href="{{route('cart.index')}}"><i class="fa fa-shopping-cart" style="font-size:20px;"></i> <span>{{ Cart::count() }}</span></a>
                              </li>
                              @endif
                        </ul>
                        
                    </div>
                </div>
              </nav>
      </header>

      <div class="konten" style="min-height: 650px;">
          @yield('content')
      </div>

      <footer>
          <div class="container pt-5">

              <div class="row">

                <div class="col-sm-4 col-md-4 mb-3">
                  <h6>Beranda</h6>
                </div>

                <div class="col-sm-4 col-md-4 mb-3">
                    <h6>Produk</h6>
                    <h6 class="mt-3">Kontak</h6>
                </div>

                <div class="col-sm-4 col-md-4 mb-3">  
                  <h6>Cara Belanja</h6>
                  <h6 class="mt-3">Panduan Ukuran</h6>
                </div>

              </div>

              <hr>

              <div class="row">
                  <div class="col-6">
                      <div class="single_widget_area text-left">
                          <div class="footer_social_area">
                              <i class="fab fa-facebook-square mr-3" style="font-size:24px"></i>
                              <i class="fab fa-instagram mr-3 " style="font-size:24px"></i>
                              <i class="fab fa-twitter" style="font-size:24px"></i>
                          </div>
                      </div>
                  </div>
              </div>
              
          </div>
      </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    @yield('script')
  </body>
</html>