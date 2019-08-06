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
        <div class="card-body">
             <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="">Tambah Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Transaksi Selesai</a>
                </li>
            </ul>
            <hr class="border-bottom-primary">
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Kategori</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Search">
                        </div>
                    </div>
                    
                    <br><br>
                    <div class="row">
                     @foreach($bajus as $baju)
                        <div class="col-md-4 text-center">
                            <img  src="{{asset('storage/' . $baju->gambar1)}}"  width="190px" height="190px"><br>
                            {{$baju->nama_baju}} <br>  
                            {{"Rp " . number_format($baju->harga-$baju->diskon,0,',','.')}}
                            <br><br>
                            <button class="btn btn-outline-primary" style="width:150px;" data-toggle="modal" data-target="#detail{{$baju->id}}">Beli</button>
                        </div>
                    @endforeach 
                    </div>
                </div>
                <div class="col-md-4" style="border-left-style:solid; border-color:#4E73DF;">
                Menu
                <hr>
                Invoice
                <hr>
               <ul class="list-unstyled">
                @foreach($bajus as $baju)
                    <li class="media">
                        <img src="{{asset('storage/' . $baju->gambar1)}}" class="mr-3"  width="64px" height="64px">
                        <div class="media-body">
                        <h6 class="mt-0 mb-1"> {{$baju->nama_baju}}</h6>
                        Size <br>
                        Jumlah <br>
                       {{"Rp " . number_format($baju->harga-$baju->diskon,0,',','.')}} <br>
                        </div>
                    </li><br>
                 @endforeach 
                </ul>
                <hr>
                Pembelian <br>
                Kupon <br> 
                Subtotal <br>
                Potongan <br>
                Total <br>
                <button class="btn btn-outline-primary btn-block">Checkout</button>
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
                                    {{$baju->nama_baju}} <br class="mb-2">
                                    {{"Rp " . number_format($baju->harga-$baju->diskon,0,',','.')}}<br>
                                    <select name="size{{$baju->id}}" id="size{{$baju->id}}" class="form-control mt-2 mb-2">
                                        <option id="kosong" value="kosong" selected>PILIH UKURAN</option>
                                        @foreach($baju->jumlah as $jumlahs)
                                            @if($jumlahs->jumlah==0)
                                                <option value="kosong">{{strtoupper($jumlahs->size)}} ({{$jumlahs->jumlah}})</option>
                                            @else
                                                <option value="{{$jumlahs->size}}">{{strtoupper($jumlahs->size)}} ({{$jumlahs->jumlah}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input disabled type="number" class="form-control mb-2" placeholder="Masukkan Jumlah" name="jumlah{{$baju->id}}" id="jumlah{{$baju->id}}">
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
                else if(jumlah == 'kosong') 
                {
                    $("#warning{{$baju->id}}").html("Input Pesanana Dahulu");
                }
                else
                {
                    $('#detail{{$baju->id}}').modal('hide');
                }
            });

            $('#close{{$baju->id}}').click(function () {
                 $("#warning{{$baju->id}}").html("");
            });
            @endforeach 
        });
    </script>
@endsection

