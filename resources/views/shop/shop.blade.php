@extends('layouts.frontend')

@section('title') 
    @if(Request::get('status') == 'diskon' ? 'active' : '')
        Semua Barang Diskon
    @elseif($nama_kategori == 'All Product')
        Semua Produk
    @else
        {{$nama_kategori->name}}
    @endif
@endsection

@section('content')

        <section class="shop-index" style="margin-top:20px; margin-bottom:20px;">
            
            <div class="container" style="margin-top:85px;">
                    @if(Request::get('status') == 'diskon' ? 'active' : '')
                        <h5><b>Semua Barang Diskon</b></h5>
                    @elseif($nama_kategori == 'All Product')
                        <h5><b>Semua Produk</b></h5>
                    @else
                        <h5><b>{{$nama_kategori->name}}</b></h5>
                    @endif
                    <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="">
                            <div class="row justify-content-between">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                    <p>Menampilkan <b>{{$bajus->total()}}</b> Produk (<b>{{$bajus->total()}}</b> dari <b>{{$jumlahbaju}}</b>)</p>
                                </div>

                                <div class="col-sm-6 col-6 col-md-3 col-lg-3">
                                    <select class="form-control" onchange="location = this.value;">
                                        <option selected value="{{route('tampil')}}">Semua Produk</option>
                                        <option {{Request::get('status') == 'diskon' ? 'selected' : ''}} value="{{route('tampil',['status' => 'diskon'])}}">Diskon</option>
                                        @foreach($kategori as $kategoris)
                                        <option {{Request::get('status') == $kategoris->id ? 'selected' : ''}} value="{{route('tampil',['status' => $kategoris->id])}}">{{$kategoris->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" class="d-none" value="">
                                </div>

                                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                    <form action="#" method="get">
                                        <select name="select" id="sortByselect" class="form-control">
                                            <option selected>Sort By : </option>
                                            <option value="value">Highest Rated</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Price: $$ - $</option>
                                            <option value="value">Price: $ - $$</option>
                                        </select>
                                        <input type="submit" class="d-none" value="">
                                    </form>
                                </div>
                            </div>

                            <div class="row shop-produk">
                                @foreach($bajus as $baju)
                                    <div class="col-6 col-lg-3 col-md-6 col-sm-6 mb-3">
                                        <a href="{{route('shop.detail', ['id' => $baju->id])}}">
                                            <div class="product-grid4">
                                                <div class="product-image4">
                                                    <img class="pic-1" src="{{asset('storage/' . $baju->gambar1)}}">
                                                    <img class="pic-2" src="{{asset('storage/' . $baju->gambar2)}}">
                                                    <span class="product-new-label">New</span>

                                                    @if($baju->diskon>0)
                                                    <span class="product-discount-label">SALE</span>
                                                    @endif

                                                    @if(Auth::guard('pembeli')->user())
                                                        <a href="{{route('shop.wishlist', ['id' => $baju->id])}}" class="product-wishlist">&#10084;</a>
                                                        @foreach(Auth::guard('pembeli')->user()->Wishlist as $apa)
                                                            @if($apa->bajus_id === $baju->id)
                                                                <a href="{{route('shop.hapuswishlist', ['id' => $baju->id])}}" class="product-red">&#10084;</a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <p class="text-left mt-3 title"><a href="{{route('shop.detail', ['id' => $baju->id])}}">{{$baju->nama_baju}} </a></p>
                                                <div class="text-left mt-2 price">
                                                    @if($baju->diskon>0)
                                                            {{"Rp " . number_format(($baju->harga-$baju->diskon),0,',','.')}}
                                                        <span>{{"Rp " . number_format($baju->harga,0,',','.')}}</span>
                                                    @else
                                                        {{"Rp " . number_format($baju->harga,0,',','.')}}
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="mx-auto mt-3">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection