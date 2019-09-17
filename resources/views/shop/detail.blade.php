@extends('layouts.frontend')

@section('title') {{$baju->nama_baju}} @endsection

@section('css')
  <link rel="stylesheet" href="{{asset('frontend/css/suggest-item.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/css/rating.css')}}">
@endsection

@section('content')

  @php $pernahkomentar = 0; @endphp

  <div class="container" style="margin-top:85px;">
    <div class="row">
        <ul class="breadcrumb2">
          <li><a href="{{route('home')}}">Home</a></li>
          <li><a href="{{route('tampil')}}">Shop</a></li>
          <li><a class="breacrumb-active">{{$baju->nama}}</a></li>
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
                      <span>{{$kategoribaju->nama}}</span>
                    @endforeach
                          <h1><b>{{$baju->nama}} </b></h1>
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
                              <input type="hidden" value="{{$baju->nama}}" name="nama">
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
                                    {!!$baju->deskripsi!!}
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

      @if(Auth::guard('pembeli')->user())
        <div class="top-content mt-5 mb-5">
            <div class="container">
                <div><h3>Rekomendasi Produk</h3></div>
                <div id="carousel-example" class="carousel slide mt-5" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                      @php $a=0; @endphp
                          @foreach($hasil as $hasil)
                              @foreach($bajurekomendasi as $rekomendasi)
                                @if($rekomendasi->id != $baju->id && $hasil['id']==$rekomendasi->id)
                                        @if($a==0)
                                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                                        @else
                                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                                        @endif
                                          <img src="{{asset('storage/' . $rekomendasi->gambar1)}}" class="img-fluid mx-auto d-block" alt="img{{$a+1}}">
                                          <h3 class="text-center"><b>{{$rekomendasi->nama}}</b></h3>
                                              <div class="price text-center">
                                                @if($rekomendasi->diskon>0)  
                                                {{"Rp " . number_format(($rekomendasi->harga-$rekomendasi->diskon),0,',','.')}}
                                                    <del>{{"Rp " . number_format($rekomendasi->harga,0,',','.')}}</del>
                                                @else
                                                    {{"Rp " . number_format($rekomendasi->harga,0,',','.')}}
                                                @endif
                                              </div>
                                        </div>
                                        @php $a=$a+1; @endphp
                                @endif
                              @endforeach
                          @endforeach
                    </div>
                </div>
            </div>
        </div>

      @else               
        <div class="top-content mt-5 mb-5">
            <div class="container">
                <hr>
                <div><h3><B>Produk Serupa</B></h3></div>
                <div id="carousel-example" class="carousel slide mt-3" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                      @php $a=0; @endphp
                          @foreach($kategoris as $kategori)
                              @foreach($baju->kategori as $kategoribaju)
                                @if($kategori->nama == $kategoribaju->nama)
                                    @foreach($kategori->baju as $bajus)
                                      @if($bajus->id != $baju->id)
                                        @if($a==0)
                                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                                        @else
                                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                                        @endif
                                              <img src="{{asset('storage/' . $bajus->gambar1)}}" class="img-fluid mx-auto d-block" alt="img{{$a+1}}">
                                              <h4 class="text-center mt-2"><b>{{$bajus->nama}}</b></h4>
                                              <div class="price text-center">
                                                @if($bajus->diskon>0)  
                                                <b>{{"Rp " . number_format(($bajus->harga-$bajus->diskon),0,',','.')}}</b>
                                                    <del>{{"Rp " . number_format($bajus->harga,0,',','.')}}</del>
                                                @else
                                                   <b> {{"Rp " . number_format($bajus->harga,0,',','.')}}</b>
                                                @endif
                                              </div>
                                        </div>
                                        @php $a=$a+1; @endphp
                                      @endif
                                    @endforeach
                                @endif
                              @endforeach
                            @endforeach
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
      @endif

        <div class="container mt-5 mb-5">
            <hr style="margin-top:50px;">
            <div><h3>Review Produk</h3></div>
            <div class="">
            @if($baju->rating->count()==0)
                  Pakaian ini Belum Memiliki Rating
            @else
                @if(round($baju->rating->avg('rating'),2)<=1.5)
                  <h4>★
                @elseif((round($baju->rating->avg('rating'),2)<=2.5))
                  <h4>★★
                @elseif((round($baju->rating->avg('rating'),2)<=3.5))
                  <h4>★★★
                @elseif((round($baju->rating->avg('rating'),2)<=4.5))
                  <h4>★★★★
                @else
                  <h4>★★★★★
                @endif <span class="small">{{$baju->rating->count()}} Ulasan </span></h4>
            @endif
            </div>
            <hr>
            @foreach($baju->rating->reverse() as $rating)
            <div class="media-body border-2">
              <span class="mt-0">
              @for($i=0;$i<$rating->rating;$i++)
                ★
              @endfor
              <br>
              <p style="font-size:14px;">Oleh <b>{{$rating->nama_pembeli->nama_lengkap}}</b>
              {{date('d M Y', strtotime($rating->created_at))}}</p>
              {{$rating->komentar}}</span>
              @if(Auth::guard('pembeli')->user())
                @if(Auth::guard('pembeli')->user()->id==$rating->pembeli_id)
                  @php $pernahkomentar = 1; @endphp
                @endif
              @endif
            </div>
            <hr>
            @endforeach
            @if(Auth::guard('pembeli')->user() && $pernahkomentar != 1)
            <div class="kolom-komentar">
              <div class="rate">
                <input class="bintang" type="radio" id="star5" name="rate" value="5"/>
                <label for="star5" title="text">5 stars</label>
                <input class="bintang" type="radio" id="star4" name="rate" value="4"/>
                <label for="star4" title="text">4 stars</label>
                <input class="bintang" type="radio" id="star3" name="rate" value="3"/>
                <label for="star3" title="text">3 stars</label>
                <input class="bintang" type="radio" id="star2" name="rate" value="2"/>
                <label for="star2" title="text">2 stars</label>
                <input class="bintang" type="radio" id="star1" name="rate" value="1"/>
                <label for="star1" title="text">1 star</label>
              </div>
              <div>
                <textarea class="form-control" id="komentar" rows="2" placeholder="Tulis Komentar"></textarea>
              </div>
              <input type="hidden" id="userid" value="{{Auth::guard('pembeli')->user()->id}}">
              <input type="hidden" id="bajuid" value="{{$baju->id}}">
              <button class="btn btn-dark btn-sm mt-2" id="postkomentar">Post</button>
            </div>
            @elseif($pernahkomentar == 1)
            <div>
                <h6 class="">Terima Kasih Telah Memberi Komentar</h6>
            </div>
            @else
            <div>
                <h6 class="">Silahkan <a href="{{route('pembeli.login')}}"><u>Login</u></a> Untuk Memberi Komentar</h6>
            </div>
            @endif
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

  jQuery('#postkomentar').on('click', function () {
      var rating = Number($('.bintang:checked').val());
      var komentar = $('#komentar').val();
      var userid = $('#userid').val();
      var bajuid = $('#bajuid').val();

      jQuery.ajax({
                //  url: 'https://wisnusetyawann.xyz/cart/city/'+provId,
                url: 'http://localhost:8000/rating/tambahrating/' + userid + '/' + komentar + '/' + rating + '/' + bajuid,
                type: "GET",
                dataType: "json",

            success: function (data) 
            {
                if (data) 
                {
                   location.reload();
                   $('$nav-review-tab').click();
                } 
            }
          });

        });
  
  </script>
@endsection
