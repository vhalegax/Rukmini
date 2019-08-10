@extends('layouts.frontend')
@section('meta')
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('title') Belanjaan @endsection
@section('content')

    <div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
        <div class="container">
            <div class="col-12">
                <div class="text-center center">
                <h2>Belanjaan</h2>
                </div>
            </div>
        </div>
    </div>

    <section class="mt-5">
        <div class="container">

            <div class="profile-pembeli2">
                <a  href="{{route('pembeli.index')}}">Profile</a>
                <a  href="{{route('alamat.index',['status'=>'daftar'])}}" >Daftar Alamat</a>
                <a  class="active"  href="{{route('cart.index')}}"  >Keranjang Belanjaan</a>
                <a  href="{{route('checkout.index')}}">Pembayaran</a>
                <a  href="{{route('pembeli.wishlist')}}">Wishlist</a>
                <a href="{{route('pembeli.wishlist')}}">Riwayat Transaksi</a>
            </div>

            <div class="row border bingkai">
                <div class="col-12 col-md-12">
                
                    <div class=""  style="margin-bottom:-20px;">
                        @if(Auth::guard('pembeli')->user())
                        <h6 id="jumlahbelanjaan">Barang Belanjaan : {{ Cart::count() }} </h6>
                        @else
                        <h6 id="jumlahbelanjaan">Barang Belanjaan : {{ Cart::count() }} </h6>
                        @endif
                        <p id="beratbelanjaan">Berat Belanjaan : {{Cart::count()*0.3}} Kg<p>
                        <br>
                    </div>

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
                    
                    
                    <div class="table-responsive">
                        <table class="table ">
                            <tbody>
                                <?php foreach(Cart::content() as $row) :?>
                                <input type="hidden" name="{{$row->rowId}}tempqty" value="{{$row->qty}}">   
                                <input type="hidden" name="{{$row->rowId}}price" value="{{$row->price}}">   
                                    <tr>
                                        <td style="width:150px;"><img src="{{asset('storage/' . $row->model->gambar1)}}" style=" height: 150px; width: 150px;"></td>
                                        <td style="width:500px;"><b>{{$row->name}}</b> <br>
                                        {{strtoupper($row->options->size)}}
                                        <br>
                                            <b id="{{$row->rowId}}tprice">{{"Rp " . number_format(($row->qty*$row->price),0,',','.')}}</b> 
                                            <br class="mb-3">
                                            <div class="mt-2 mb-2">
                                                <button class="btn btn-outline-dark btn-sm" id="{{$row->rowId}}" onClick="kurang(this.id)" type="submit"><center><b>-</b></center></button>
                                                <button class="btn btn-outline-dark btn-sm"><center><b id="{{$row->rowId}}qty">{{$row->qty}}</b></center></button>
                                                <button class="btn btn-outline-dark btn-sm" id="{{$row->rowId}}"onClick="tambah(this.id)" type="submit"><center><b>+</b></center></button>
                                            </div>
                                            <form action="{{ route('cart.destroy', $row->rowId) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-outline-danger btn-sm" type="submit" value="save">Hapus Cart</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <td colspan="8">&nbsp;</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="">
                        <hr>
                        <h5 class="mb-3">Alamat Pengiriman</h5>

                        </div>
                            @if(Auth::guard('pembeli')->user())
                            <button class="btn btn-outline-secondary btn-sm" type="submit" data-toggle="modal" data-target="#DaftarAlamat">Pilih Alamat</button><br><br>
                            @else
                        
                            @endif
                        
                            <form enctype="multipart/form-data" 
                                    action="{{route('checkout.store')}}" 
                                    method="POST">
                                    
                                    @csrf

                                    <div class="row">
                                       <input type="hidden" name="idalamat" value="0">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama">Nama Penerima</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="" required
                                            placeholder="Masukkan Nama Penerima">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="telp">No Telp</label>
                                            <input type="number" class="form-control" id="telp" name="telp" value="" required
                                            placeholder="Masukkan No Telp Penerima">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="alamat">Alamat Jalan</label>
                                            <textarea type="text" class="form-control" id="alamat" name="alamat" value="" 
                                            required placeholder="Masukkan Alamat Jalan Lengkap RT RW"></textarea>
                                        </div>

                                        <div class="col-md-4 mb-3 form-group">
                                        <label for="provinsi">Pilih Provinsi</label>
                                            <select required name="prov" id="prov" class="form-control">
                                                    @foreach ($provinci as $value)                               
                                                        <option value="{{$value->id}}">{{$value->name}}</option>                                    
                                                    @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3 form-group">
                                                <label required for="kota">Pilih Kota / Kecamatan</label>
                                                <select name="cities" class="form-control" id='cities'>
                                                    <option></option>        
                                                </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input required type="text" class="form-control" id="kode_pos" name="kode_pos" value="" >
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="jasa">Jasa Pengiriman</label>
                                            <select required name="jasa" id="jasa" class="form-control">
                                                <option value="">Pilih Pengiriman</option>
                                                <option value="JNE">JNE</option>
                                                <option value="TIKI">TIKI</option>
                                                <option value="POS">Pos Indonesia</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="ongkir">Pilih Service</label>
                                            <select required name="ongkirservice" class="form-control"> 
                                            <option></option>    
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                        <div class="offset-md-8 col-md-4">
                                            <input type="text" class="form-control" id="kupon" name="kupon" value="" placeholder="Massukkan Kode Kupon">
                                            <p class="text-danger text-monospace mt-1" id="kuponwarning"></p>
                                        </div>
                                    </div>

                                    <!-- berat -->
                                    <input type="hidden" value="{{Cart::count()*300}}" id="berat" name="berat"> 
                                    <!-- subtotal barang -->
                                    <input type="hidden" value="{{Cart::total(0)}}" id="barang" name="barang">
                                    <!-- potongan kupon -->
                                    <input type="hidden" value="" id="potongankupon" name="potongankupon">
                                    <!-- ongkir -->
                                    <input type="hidden" id="ongkir" name="ongkir" value="">
                                    <!-- total semua -->
                                    <input type="hidden" id="total" name="total" value="">

                                    
                                    <div class="text-right">
                                        <br>
                                        <label for=""><b>Subtotal : &nbsp <b id="barangtampil">Rp {{Cart::total(0)}}</b> </b></label><br>
                                        <label for=""><b>Kupon : &nbsp </b><b id="kupontampil">0</b></label><br>
                                        <label for=""><b>Ongkir : &nbsp </b><b id="ongkirtampil">0</b></label><br>
                                        <label for=""><b>Total :  &nbsp </b><b id="totaltampil">0</b></label><br><br>
                                        <button class="btn btn-outline-secondary" type="submit" value="save"><a href="{{route('tampil')}}">Belanja Lagi</a></button>
                                        @if(Auth::guard('pembeli')->user())
                                        <button class="btn btn-outline-secondary" type="submit" value="save">Check Out</button>
                                        @else
                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#Login">Check Out</button>
                                        @endif
                                    </div>
                            </form>
                        </div>

                        @if(Auth::guard('pembeli')->user())
                        <div id="DaftarAlamat" class="modal fade">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Daftar Alamat</h5>
                                    </div>
                                    <div class="modal-body">
                                        @foreach($alamat->Alamat as $alamats)
                                        <div class="card">
                                            <div class="card-body">
                                            @if(empty($alamat))
                                              <h3>Belum Ada Alamat</h3>
                                            @else
                                            <input type="hidden" id="a{{$alamats->id}}dnama" value="{{$alamats->nama}}">
                                            <input type="hidden" id="a{{$alamats->id}}dtelp" value="{{$alamats->telp}}">
                                            <input type="hidden" id="a{{$alamats->id}}djalan" value="{{$alamats->jalan}}">
                                            <input type="hidden" id="a{{$alamats->id}}dkotaid" value="{{$alamats->kota}}">
                                            <input type="hidden" id="a{{$alamats->id}}dkota" value="{{$alamats->Kota->name}}">
                                            <input type="hidden" id="a{{$alamats->id}}dprovid" value="{{$alamats->provinsi}}">
                                            <input type="hidden" id="a{{$alamats->id}}dprov" value="{{$alamats->Provinsi->name}}">
                                            <input type="hidden" id="a{{$alamats->id}}dkode" value="{{$alamats->kode_pos}}">
                                            <input type="hidden" id="a{{$alamats->id}}did" value="{{$alamats->id}}">
                                            <small><H6 class="card-text">{{$alamats->nama}}</h6></small>
                                            <small><p class="card-text">{{$alamats->telp}}</p></small>
                                            <small><p class="card-text">{{$alamats->jalan}}</p></small>
                                            <small><p class="card-text">{{$alamats->kode_pos}} , {{$alamats->Kota->name}} , {{$alamats->Provinsi->name}}</p></small>
                                            <br>
                                            <button type="button" onClick="alamat(this.id)" class="btn btn-outline-secondary btn-sm" id="a{{$alamats->id}}" data-dismiss="modal">Pilih</button>
                                            </div>
                                            @endif
                                        </div>
                                        <br>
                                        @endforeach
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
            </div>
        </div> 
    </section>

    <div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="warningtext"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">OK</button>
            </div>
            </div>
        </div>
    </div>

    @if(session('info'))
    <div class="modal fade" id="gagalbelanja" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-show="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Mohon Maaf Barang Yang Anda Ingin Beli Mengalami Perubahan Stok <br>
                Silahkan Belanja Ulang , Terima Kasih</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary"><a href="{{route('tampil')}}">Belanja Lagi</a></button>
            </div>
            </div>
        </div>
    </div>
    @endif
  

    <div id="Login" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login Untuk Membayar</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="col-md-12">
                    <input type="hidden"  value="PUT"  name="_method">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="bank" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <div>
                                <input type="number" class="form-control input-lg" name="rek" >
                            </div>
                        </div>
                    </div>
                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-outline-primary">
                                    Masuk
                                </button>

                                <a class="btn btn-outline-secondary" href="{{ route('password.request') }}">
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                        </div>

                            <div class="col-md-8 col-md-offset-4">
                                Belum Punya Akun?<a href="{{route('pembeli.create')}}"><b> Buat Disini</b></a>
                            </div><br>

                            <div class="col-md-12">
                                <table width="100%">
                                    <tr>
                                        <td><hr /></td>
                                        <td style="width:1px; padding: 0 10px; white-space: nowrap;">ATAU</td>
                                        <td><hr /></td>
                                    </tr>
                                </table>​
                            </div>

                            <div class="col-md-12 mb-2">
                                <button type="submit" class="btn btn-outline-primary btn-block"> Masuk Dengan Facebook </button>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-danger btn-block"> Masuk Dengan Google </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{asset('js/city.js')}}"></script>
<script src="{{asset('js/jumlahbelanjaan.js')}}"></script>
@endsection