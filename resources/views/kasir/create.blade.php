@extends("layouts.dashboard")

@section("title") Kasir @endsection 

@section('pageTitle') Kasir @endsection

@section("content")

    @if(session('status'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif 


    <div class="card shadow mb-2">
        <div class="p-2">
             <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="">Tambah Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Transaksi Selesai</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                       <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th><b>Gambar</b></th>
                                <th><b>Nama</b></th>
                                <th><b>Kategori</b></th>
                                <th><b>Harga</b></th>
                                <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bajus as $baju)
                                <tr>
                                <td><img  src="{{asset('storage/' . $baju->gambar1)}}"  width="100px" height="100px"></td>
                                <td>{{$baju->nama_baju}}</td>
                                <td>  
                                    @foreach($baju->kategori as $category)
                                        <li>{{$category->name}}</li>  
                                    @endforeach
                                </td>
                                <td>{{"Rp " . number_format($baju->harga-$baju->diskon,0,',','.')}}</td>
                                <td><button class="btn btn-outline-primary" style="width:150px;" data-toggle="modal" data-target="#detail{{$baju->id}}">Beli</button></td>
                                </tr>
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan=12>
                                    {{$bajus->appends(Request::all())->links()}}        
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-4" style="border-left-style:solid;">
                    <ul class="list-unstyled tampil-cart">
                    </ul>
                    <hr>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="kuponinput" value="" placeholder="Massukkan Kode Kupon">
                            <input type="hidden" class="form-control" id="potongankupon" value="0">
                            <p class="text-danger text-monospace mt-1" id="kuponwarning2"></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <b>Subtotal : <span class="subtotal-cart"></b> <br>
                        <b>Potongan : <span id="kupontampil"></b> <br>
                        <b>Total : <span class="total-cart"></b> <br>
                    </div><br>
                    <button class="btn btn-outline-primary btn-block" id="checkout">Checkout</button>
                    <button class="clear-cart btn btn-outline-danger btn-block">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>

    @foreach($bajus as $baju)
    <div id="detail{{$baju->id}}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail</h5>
                    <button type="button" class="close" id="close{{$baju->id}}" aria-label="Close"  data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                     <img  class="border" src="{{asset('storage/' . $baju->gambar1)}}"  width="205px" height="205px">
                                </div>
                                <div class="col-md-6">
                                    @php $harga = $baju->harga-$baju->diskon; @endphp
                                    <input type="hidden" id="idbaju{{$baju->id}}" value="{{$baju->id}}">
                                    <input type="hidden" id="nama{{$baju->id}}" value="{{$baju->nama_baju}}">
                                    <input type="hidden" id="harga{{$baju->id}}" value="{{$harga}}">
                                    <input type="hidden" id="img{{$baju->id}}" value="{{asset('storage/' . $baju->gambar1)}}">
                                    {{$baju->nama_baju}}<br class="mb-2">
                                    {{"Rp " . number_format($harga)}}<br>
                                    <select id="size{{$baju->id}}" class="form-control mt-2 mb-2">
                                        <option id="kosong" value="kosong" selected>PILIH UKURAN</option>
                                        @foreach($baju->jumlah as $jumlahs)
                                            @if($jumlahs->jumlah==0)
                                                <option value="kosong">{{strtoupper($jumlahs->size)}} ({{$jumlahs->jumlah}})</option>
                                            @else
                                                <option value="{{$jumlahs->size}}">{{strtoupper($jumlahs->size)}} ({{$jumlahs->jumlah}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input disabled type="number" class="form-control mb-2" placeholder="Masukkan Jumlah" id="jumlah{{$baju->id}}">
                                    <button class="btn btn-outline-primary btn-block mb-2" id="beli{{$baju->id}}">Beli</button>
                                    <b id="warning{{$baju->id}}" class="text-danger"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    @endforeach 

@endsection

@section('footer-scripts')
    <script>
        jQuery(document).ready(function () {
            @foreach($bajus as $baju)
            $('#size{{$baju->id}}').change(function () {
                $("#warning{{$baju->id}}").html("");
                var value = $(this).val();
                if (value == 'kosong') {
                    $("#warning{{$baju->id}}").html("Maaf Barang Habis");
                    document.getElementById("size{{$baju->id}}").selectedIndex = "0";
                    $('#jumlah{{$baju->id}}').val("");
                    $('#jumlah{{$baju->id}}').prop('disabled', true);
                }
                else
                {
                    $('#jumlah{{$baju->id}}').val("");
                    $('#jumlah{{$baju->id}}').prop('disabled', false);
                }
            });

            $('#jumlah{{$baju->id}}').change(function () {
                var size = $("#size{{$baju->id}}").val();
                var jumlah = $(this).val();
                @foreach($baju->jumlah as $jumlahs)
                    
                    if("{{$jumlahs->size}}"==size)
                    {     
                        if(jumlah<1)
                        {
                            $('#jumlah{{$baju->id}}').val("");
                            $("#warning{{$baju->id}}").html("Jumlah Kurang Dari 1");
                        }
                        else if(jumlah>{{$jumlahs->jumlah}})
                        {
                            $('#jumlah{{$baju->id}}').val("");
                            $("#warning{{$baju->id}}").html("Stok tidak ada");
                        }
                        else
                        {
                            $("#warning{{$baju->id}}").html("");
                        }
                    }
                @endforeach
             });

            $('#beli{{$baju->id}}').click(function () {
                var size = $("#size{{$baju->id}}").val();
                var jumlah = $("#jumlah{{$baju->id}}").val();
                if (size == 'kosong') 
                {
                    $("#warning{{$baju->id}}").html("Input Pesanana Dahulu");
                }
                else if(jumlah == '') 
                {
                    $("#warning{{$baju->id}}").html("Input Pesanana Dahulu");
                }
                else
                {
                    var idbaju = $("#idbaju{{$baju->id}}").val();
                    var nama = $("#nama{{$baju->id}}").val();
                    var harga = Number($("#harga{{$baju->id}}").val());
                    var img = $("#img{{$baju->id}}").val();
                    var id = idbaju+size;
                    shoppingCart.addItemToCart(id, idbaju, nama, harga, size, jumlah,img);
                    displayCart();
                    $('#jumlah{{$baju->id}}').val("");
                    $("#warning{{$baju->id}}").html("");
                    $('#detail{{$baju->id}}').modal('hide');
                    cek_kupon();
                }
            });

            // Clear items
            $('.clear-cart').click(function() {
            shoppingCart.clearCart();
            displayCart();
            cek_kupon();
            });

            $('#close{{$baju->id}}').click(function () {
                 $("#warning{{$baju->id}}").html("");
            });
            @endforeach 
        });

        var shoppingCart = (function() {
        cart = [];
    
        // Constructor
        function Item(id, idbaju, nama, harga, size, jumlah, img) {
            this.id = id;
            this.idbaju = idbaju;
            this.nama = nama;
            this.harga = harga;
            this.size = size;
            this.jumlah = jumlah;
            this.img = img;
        }
        
        // Save cart
        function saveCart() {
            sessionStorage.setItem('CartKasir', JSON.stringify(cart));
        }
        
        // Load cart
        function loadCart() {
            cart = JSON.parse(sessionStorage.getItem('CartKasir'));
        }
        
        if (sessionStorage.getItem("CartKasir") != null) {
            loadCart();
        }
        
        var obj = {};
        
        // tambah item
        obj.addItemToCart = function(id, idbaju, nama, harga, size, jumlah, img) {
            for(var item in cart) {
                if(cart[item].idbaju === idbaju && cart[item].size ===size) {
                    $("#warning{{$baju->id}}").html("Size dan Nama Sudah Ada");
                    $('#jumlah{{$baju->id}}').val("");
                    $("#warning{{$baju->id}}").html("");
                    return;
                }
            }
            var item = new Item(id, idbaju, nama, harga, size, jumlah, img);
            cart.push(item);
            saveCart();
        }

        // -1
        obj.removeItemFromCart = function(id) {
            for(var item in cart) {
                if(cart[item].id === id) 
                {
                    if(cart[item].jumlah != 1) {
                        cart[item].jumlah --;
                    }
                    break;
                }
            }
            saveCart();
        }

         // +1
         
        obj.plusItemFromCart = function(id,idbaju,size) {
            for(var item in cart) {
                if(cart[item].id === id) 
                {
                    @foreach($bajus as $baju)
                         if(idbaju == {{$baju->id}})
                         {
                             @foreach($baju->jumlah as $jumlahs)
                             if (size == "{{$jumlahs->size}}")
                             {
                                if(cart[item].jumlah < {{$jumlahs->jumlah}})
                                {
                                    cart[item].jumlah ++;
                                    break;
                                }
                             }
                             @endforeach
                         }
                    @endforeach
                }
            }
            saveCart();
        }

        // Hapus Item dari Belanjaan
        obj.removeItemFromCartAll = function(id) {
            for(var item in cart) {
            if(cart[item].id === id) {
                cart.splice(item, 1);
                break;
            }
            }
            saveCart();
        }

        // Bersihkan Belanjaan
        obj.clearCart = function() {
            cart = [];
            saveCart();
        }

        // SubTotal Belanjaan
        obj.subtotalCart = function() {
            var totalCart = 0;
            for(var item in cart) {
            totalCart += cart[item].harga * cart[item].jumlah;
            }
            return Number(totalCart);
        }

        // Total Dengan Kupon
        obj.totalCart = function() {
            var totalCart = 0;
            var kupon = Number($('#potongankupon').val());
            for(var item in cart) {
            totalCart += cart[item].harga * cart[item].jumlah;
            }
            totalCart = totalCart-kupon;
            return Number(totalCart);
        }

        // List cart
        obj.listCart = function() {
            var cartCopy = [];
            for(i in cart) {
            item = cart[i];
            itemCopy = {};
            for(p in item) {
                itemCopy[p] = item[p];
            }
            itemCopy.subtotal = Number(item.harga * item.jumlah);
            cartCopy.push(itemCopy)
            }
            return cartCopy;
        }

        return obj;
        })();

        function displayCart() {
            var cartArray = shoppingCart.listCart();
            var output = "Belum Ada Pembelian";
            for(var i in cartArray) {
                output += "<li class='media'>"
                + "<img src='"+ cartArray[i].img +"' class='mr-3'  width='150px' height='150px'>"
                + "<div class='media-body'>"
                + "<h6 class='mt-0 mb-1'>" +cartArray[i].nama + " / " + cartArray[i].id + "</h6>"
                + "<p class='mt-0 mb-1'>" +cartArray[i].size + "</p>"
                + "<p class='mt-0 mb-1'> Rp " +thousands_separators(cartArray[i].subtotal) + "</p>"
                + "<button class='btn btn-outline-dark btn-sm minus-item' data-id='"+cartArray[i].id+"'><center><b>-</b></center></button>"
                + "<button class='btn btn-outline-dark btn-sm'><center><b>" + cartArray[i].jumlah + "</b></center></button>"
                + "<button class='btn btn-outline-dark btn-sm plus-item'  data-size='"+cartArray[i].size+"' data-id='"+cartArray[i].id+"' data-idbaju='"+cartArray[i].idbaju +"'><center><b>+</b></center></button></br>"
                + "<button class='btn-sm btn btn-outline-danger mt-2 hapus' style='width:75px'  data-id=" + cartArray[i].id + ">Hapus</button>"
                + "</div>"
                + "</li><br>";
            }
            $('.tampil-cart').html(output);
            $('.subtotal-cart').html('Rp ' + thousands_separators(shoppingCart.subtotalCart()));
            $('#kupontampil').html('Rp ' + thousands_separators($('#potongankupon').val()));
            $('.total-cart').html('Rp ' + thousands_separators(shoppingCart.totalCart()));
        }

        // Delete item button

        $('.tampil-cart').on("click", ".hapus", function(event) {
        var id = $(this).data('id')
        shoppingCart.removeItemFromCartAll(id);
        displayCart();
        cek_kupon();
        })


        // -1
        $('.tampil-cart').on("click", ".minus-item", function(event) {
        var id = $(this).data('id')
        shoppingCart.removeItemFromCart(id);
        displayCart();
        cek_kupon();
        })

        // +1
        $('.tampil-cart').on("click", ".plus-item", function(event) {
        var id = $(this).data('id');
        var idbaju = $(this).data('idbaju');
        var size = $(this).data('size');
        shoppingCart.plusItemFromCart(id,idbaju,size);
        displayCart();
        cek_kupon();
        })

        displayCart();

        // Kupon
        $('#kuponinput').change(function () {
            cek_kupon();
        })

        $('#checkout').click(function()
        {
            cart = [];
            cart = JSON.parse(sessionStorage.getItem('CartKasir'));
            apa = 1;
            if (cart!=null)
            {
                jQuery.ajax({
                url: 'http://localhost:8000/karyawan/kasir/store',
                type: "POST",
                data: cart,
                success: function()
                {
                    $(location).attr('href','http://localhost:8000/karyawan/kasir/' + apa,); // You URL inserted
                }
            });
            }
        })
        
        
        function thousands_separators(num) {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return num_parts.join(".");
        }

        function cek_kupon()
        {
            var kupon = $('#kuponinput').val();
            var subtotal = shoppingCart.subtotalCart();
            if (kupon!=null) {
                jQuery.ajax({
                    //  url: 'https://wisnusetyawann.xyz/cart/cekkupon/'+kupon,
                    url: 'http://localhost:8000/cart/cekkupon/' + kupon + '/' + subtotal,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function () {
                        $('#loader').css("visibility", "visible");
                    },

                    success: function (data) {
                        if (data['info'] == 'ada') 
                        {
                            if (data['status'] == null) {
                                $('#kuponwarning2').html("");
                                $('#kupontampil').html('Rp 0');
                                $('#potongankupon').val(data["potongan"]);
                                displayCart();
                            } else {
                                $('#potongankupon').val(0);
                                $('#kupontampil').html("0");
                                $('#kuponwarning2').html(data['status']);
                                $('#kupontampil').html(data['status']);
                                displayCart();
                            }
                        } 
                        else if (data['info'] == 'tidakada')
                        {
                             $('#potongankupon').val(0);
                            $('#kupontampil').html("0");
                            $('#kuponwarning2').html("Kupon tidak ada" + data['1']);
                            displayCart();
                        }
                    },
                    complete: function () {
                        $('#loader').css("visibility", "hidden");
                    }
                });
            } 
            else {
                $('#kuponwarning2').html("");
            }
        }

    </script>
@endsection

