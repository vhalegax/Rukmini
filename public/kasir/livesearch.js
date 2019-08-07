 $(document).ready(function ($) {
     $('#livesearch').on('keyup', function () {
         <
         div class = "col-md-8 kontenjualan" >
             <
             br > < br >
             <
             div class = "row" >
             @foreach($bajus as $baju) <
             div class = "col-md-4 text-center" >
             <
             img src = "{{asset('storage/' . $baju->gambar1)}}"
         width = "190px"
         height = "190px" > < br > {
                 {
                     $baju - > nama_baju
                 }
             } < br > {
                 {
                     "Rp ".number_format($baju - > harga - $baju - > diskon, 0, ',', '.')
                 }
             } <
             br > < br >
             <
             button class = "btn btn-outline-primary"
         style = "width:150px;"
         data - toggle = "modal"
         data - target = "#detail{{$baju->id}}" > Beli < /button> <
             /div>
         @endforeach
             <
             /div> <
             /div>
     });

 });
