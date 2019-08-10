@extends('layouts.frontend')

@section('title') {{$baju->nama_baju}} @endsection

@section('css')
  <link rel="stylesheet" href="{{asset('frontend/css/suggest-item.css')}}">
@endsection

@section('content')

  <div class="container" style="margin-top:85px;">
    <div class="row">
        <ul class="breadcrumb2">
          <li><a href="{{route('home')}}">Home</a></li>
          <li><a href="{{route('tampil')}}">Shop</a></li>
          <li><a  class="breacrumb-active">{{$baju->nama_baju}}</a></li>
        </ul>
    </div>
  </div>
  

  <section class="detail-produk-full">
          <div class="container">
              <div class="row">
                  <div class="col-sm-12 col-md-7 col-lg-8 ">
                        <div class="image-gallery">
                            <div id="big">
                                <img src="{{asset('storage/' . $baju->gambar1)}}" alt="">
                            </div>
                            
                            <div id="sub">
                                <img src="{{asset('storage/' . $baju->gambar1)}}" alt="">
                                <img src="{{asset('storage/' . $baju->gambar2)}}" alt="">
                                <img src="{{asset('storage/' . $baju->gambar3)}}" alt="">
                                <img src="{{asset('storage/' . $baju->gambar4)}}" alt="">
                            </div>
                        </div>
                    </div>
                    
                  <div class="col-sm-12 col-md-5 col-lg-4">
                      <div class="detail-produk">
                        @foreach($baju->kategori as $kategoribaju)
                          <span>{{$kategoribaju->name}}</span>
                        @endforeach
                              <h1><b>{{$baju->nama_baju}} </b></h1>
                              <div class="price mb-4">
                                @if($baju->diskon>0)  
                                <b style="color: black">{{"Rp " . number_format(($baju->harga-$baju->diskon),0,',','.')}}</b>
                                    <del style="color: grey">{{"Rp " . number_format($baju->harga,0,',','.')}}</del>
                                @else
                                    <b style="color: black">{{"Rp " . number_format($baju->harga,0,',','.')}}</b>
                                @endif
                              </div>

                              <form class="cart-form clearfix" action="{{ route('cart.store', $baju) }}" method="POST">
                                  {{ csrf_field() }}
                                    <div class="form-group">
                                        <select name="size" id="size" class="form-control">
                                        <option id="kosong" value="kosong">PILIH UKURAN</option>
                                          @foreach($baju->jumlah as $jumlahs)
                                            @if($jumlahs->jumlah==0)
                                            {
                                              <option value="kosong">{{strtoupper($jumlahs->size)}} ({{$jumlahs->jumlah}})</option>
                                            }
                                            @else
                                            {
                                              <option value="{{$jumlahs->size}}">{{strtoupper($jumlahs->size)}} ({{$jumlahs->jumlah}})</option>
                                            }
                                            @endif
                                          @endforeach
                                        </select>
                                    </div>
                                  <input type="hidden" name="jumlah" value="1" class="form-control">
                                  <input type="hidden" value="{{$baju->id}}" name="id">
                                  <input type="hidden" value="{{$baju->nama_baju}}" name="nama">
                                  <input type="hidden" value="{{$baju->harga-$baju->diskon}}" name="harga">
                                  <button type="submit" value='submit' id="beli" name="addtocart" class="btn btn-dark btn-block mb-4">Tambah Ke Keranjang</button>
                              </form>

                                  <ul class="nav nav-tabs">
                                      <li class="nav-item">
                                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi</a>
                                      </li>
                                      <li class="nav-item">
                                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ukuran</a>
                                      </li>
                                  </ul>

                                  <div class="tab-content mt-3 mb-5" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        {{$baju->deskripsi}}
                                    </div>

                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <img src="{{asset('frontend/img/size.png')}}" alt="" height="100%" width="100%">
                                    </div>
                                  </div>
                            </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
                        
      <div class="top-content mt-5 mb-5">
          <div class="container">
              <div class="hr-sect"><h3>Produk Serupa</h3></div>
              <div id="carousel-example" class="carousel slide mt-5" data-ride="carousel">
                  <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    @php $a=0; @endphp
                      @while($a<=4)
                        @foreach($kategoris as $kategori)
                            @foreach($baju->kategori as $kategoribaju)
                              @if($kategori->name == $kategoribaju->name)
                                  @foreach($kategori->baju as $bajus)
                                    @if($bajus->id != $baju->id)
                                      @if($a==0)
                                      <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                                      @else
                                      <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                                      @endif
                                        <img src="{{asset('storage/' . $bajus->gambar1)}}" class="img-fluid mx-auto d-block" alt="img{{$a+1}}">
                                        <p class="text-center">{{$bajus->nama_baju}}</p>
                                            <div class="price text-center">
                                              @if($bajus->diskon>0)  
                                              {{"Rp " . number_format(($bajus->harga-$bajus->diskon),0,',','.')}}
                                                  <del>{{"Rp " . number_format($bajus->harga,0,',','.')}}</del>
                                              @else
                                                  {{"Rp " . number_format($bajus->harga,0,',','.')}}
                                              @endif
                                            </div>
                                      </div>
                                      @php $a=$a+1; @endphp
                                    @endif
                                  @endforeach
                              @endif
                            @endforeach
                          @endforeach
                      @endwhile
                  </div>

                  <a class="carousel-control-prev prev" href="#carousel-example" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>

                  <a class="carousel-control-next next" href="#carousel-example" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalhabis" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <p class="modal-title" id="exampleModalLongTitle">Maaf Barang Habis</p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalpilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <p class="modal-title" id="exampleModalLongTitle">Silahkan Pilih Barang Dahulu</p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('script')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

  <script src="{{ asset('js/detailshop.js') }}"></script>

  <script>
    $('#carousel-example').on('slide.bs.carousel', function (e) {
        /*
            CC 2.0 License Iatek LLC 2018 - Attribution required
        */
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 5;
        var totalItems = $('.carousel-item').length;
    
        if (idx >= totalItems-(itemsPerSlide-1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i=0; i<it; i++) {
                // append slides to end
                if (e.direction=="left") {
                    $('.carousel-item').eq(i).appendTo('.carousel-inner');
                }
                else {
                    $('.carousel-item').eq(0).appendTo('.carousel-inner');
                }
            }
        }
    });
  </script>
@endsection
