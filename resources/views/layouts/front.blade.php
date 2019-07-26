<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>@yield('title')</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('front/img/core-img/favicon.ico')}}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('front/css/core-style.css')}}">
    <link rel="stylesheet" href="{{asset('front/style.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="{{route('karyawan.home')}}">Wisnu</a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('tampil')}}">Shop</a></li>
                            <li><a href="#">Fit Guide</a></li>

                        
                            @if(Auth::guard('pembeli')->user())
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" 
                            aria-haspopup="true" aria-expanded="false" href="{{route('pembeli.index')}}">
                            {{Auth::guard('pembeli')->user()->email}}</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#">Wishlist</a>
                            <a href="{{ route('pembeli.logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('pembeli.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}</form></li>

                            @elseif(\Auth::user())
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" 
                            aria-haspopup="true" aria-expanded="false" href="{{route('karyawan.home')}}">
                            {{Auth::user()->name}}</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="dropdown-item" style="cursor:pointer"><a class="dropdown-item" href="#">Logout</a></button>
                            </form>
                            </li>

                            @else
                            <li><a href="{{route('pembeli.login')}}">Login</a></li>
                            @endif     

                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="#" method="post">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <!-- Favourite Area -->
                <div class="favourite-area">
                    <a href="#"><img src="{{asset('front/img/core-img/heart.svg')}}" alt=""></a>
                </div>
                
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="{{route('cart.index')}}" id="essenceCartBtn"><img src="{{asset('front/img/core-img/bag.svg')}}" alt=""> <span>{{ Cart::count() }}</span></a>
                </div>
            </div>

        </div>
    </header>
    
    @yield("content")

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <h3 class="text-justify">ABOUT US</h3>
                            <p class="text-justify">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium 
                            purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter
                            est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. </p>
                            <div></div>
                        </div>
                        
                        <!-- Footer Menu -->
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-3">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <h3 class="text-justify">Information</h3>
                            <p class="text-justify">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium 
                            purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter
                            est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. </p>
                        </div>
                        <!-- Footer Menu -->
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo">
                            <h3 class="text-justify">Category</h3>
                            <p class="text-justify">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium 
                            purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter
                            est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. </p>
                        </div>
                        <!-- Footer Menu -->
                    </div>
                </div>
            </div>

          
           
            <hr style=" display: block;
                height: 1px;
                border: 0;
                border-top: 1px solid #ccc;
                margin: 1em 0;
                padding: 0; ">            

            <div class="row mt-5">
                <div class="col-md-6">
                    <p> Copyright &copy; 2019 By Stephanus Wisnu Setyawan  </p>
                </div>
                <div class="col-md-6">
                    <div class="single_widget_area text-right">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->


    <script src="{{asset('front/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('front/js/popper.min.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/plugins.js')}}"></script>
    <script src="{{asset('front/js/classy-nav.min.js')}}"></script>
    <script src="{{asset('front/js/active.js')}}"></script>
    
    @yield('script')

</body>

</html>