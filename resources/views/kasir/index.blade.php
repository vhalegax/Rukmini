@extends("layouts.dashboard")

@section("title") Kasir @endsection 

@section('pageTitle') Kasir @endsection

@section("content")

anjay
 <div id="tampil-cart2"></div>

@endsection

@section('footer-scripts')

 <script>

            cart = [];
            cart = JSON.parse(sessionStorage.getItem('CartKasir'));
            var output = "";
                for (var i in cart) {
                output +=  cart[i].idbaju;
                }
            
            document.getElementById('tampil-cart2').innerHTML = output;
        
    </script>


@endsection
