@extends('layouts.frontend')
@section('title') Belanjaan @endsection
@section('content')

    <div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
            <div class="container">
                <div class="col-12">
                    <div class="text-center center">
                    <h2>Alamat</h2>
                    </div>
                </div>
            </div>
        </div>

    <section class="mt-5">
        <div class="container">

            <div class="row mb-3 mt-5">
                <div class="col-12 col-md-12 col-lg-12">
                    <ul class="nav pembeli nav-tabs justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pembeli.index')}}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('alamat.index',['status'=>'daftar'])}}">Alamat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('cart.index')}}">Belanjaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('checkout.index')}}">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('pembeli.wishlist')}}">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('pembeli.history')}}">History</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row border bingkai">
                <div class="col-12 col-md-12">

                    @if(session('info'))
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('info')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif 

                    <h5 class="mb-3">Daftar Alamat Pembeli</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#Tambah">Tambah Alamat</button>
                        </div>
                    </div>

                    <div id="Tambah" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Alamat</h3>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype="multipart/form-data" action="{{route('alamat.store')}}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="nama">Nama Penerima</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="" required
                                            placeholder="Masukkan Nama Penerima">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="telp">No Telp</label>
                                            <input type="number" class="form-control" id="telp" name="telp" value="" required
                                            placeholder="Masukkan No Telp Penerima">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="alamat">Alamat Jalan</label>
                                            <textarea type="text" class="form-control" id="alamat" name="alamat" value="" 
                                            required placeholder="Masukkan Alamat Jalan Lengkap RT RW"></textarea>
                                        </div>

                                        <div class="col-md-12 mb-3 form-group">
                                        <label for="provinsi">Pilih Provinsi</label>
                                            <select name="prov" class="form-control">
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($province as $value)                               
                                                        <option value="{{$value->id}}">{{$value->name}}</option>                                    
                                                    @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3 form-group">
                                                <label for="kota">Pilih Kota / Kecamatan</label>
                                                <select name="cities" class="form-control" id='cities'>
                                                    <option></option>        
                                                </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="" >
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <button type="submit" class="btn btn-success" value="save">Konfirmasi</button>
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                        </div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                

                    @foreach($alamat->Alamat as $alamats)

                    @if(empty($alamats))
                        <h6>Belum Ada Alamat</h6>
                    @else
                    <div class="card">
                        <small><h6 class="card-header">{{$alamats->nama}}</h6></small>
                        <div class="card-body">
                            <small><p class="card-text">{{$alamats->telp}}</p></small>
                            <small><p class="card-text">{{$alamats->jalan}}</p></small>
                            <small><p class="card-text">{{$alamats->kode_pos}} , {{$alamats->Kota->name}} , {{$alamats->Provinsi->name}}</p></small>
                            <br>
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#{{$alamats->id}}">Ubah</button>
                            <form  class="d-inline"
                                action="{{route('alamat.destroy', ['id' => $alamats->id])}}"
                                method="POST"
                                onsubmit="return confirm('Hapus Alamat?')">
                                @csrf 
                                <input  type="hidden"  value="DELETE"  name="_method">
                                <input  type="submit"  class="btn btn-outline-secondary btn-sm" value="Hapus">
                            </form>
                        </div>
                    </div>
                    <br>

                    <div id="{{$alamats->id}}" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Ubah Alamat</h3>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype="multipart/form-data" action="{{route('alamat.update', ['id' => $alamats->id])}}">
                                    @csrf
                                    
                                    <input type="hidden"  value="PUT"  name="_method">
                                    
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="nama">Nama Penerima</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{$alamats->nama}}" required
                                            placeholder="Masukkan Nama Penerima">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="telp">No Telp</label>
                                            <input type="number" class="form-control" id="telp" name="telp" value="{{$alamats->telp}}" required
                                            placeholder="Masukkan No Telp Penerima">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="alamat">Alamat Jalan</label>
                                            <textarea type="text" class="form-control" id="alamat" name="alamat" 
                                            required placeholder="Masukkan Alamat Jalan Lengkap RT RW">{{$alamats->jalan}}</textarea>
                                        </div>

                                        <div class="col-md-12 mb-3 form-group">
                                        <label for="provinsi">Pilih Provinsi</label>
                                            <select name="prov" class="form-control">
                                                <option value="{{$alamats->provinsi}}">{{$alamats->Provinsi->name}}</option>
                                                @foreach ($province as $value)                               
                                                    <option value="{{$value->id}}">{{$value->name}}</option>                                    
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3 form-group">
                                            <label for="kota">Pilih Kota / Kecamatan</label>
                                            <select name="cities" class="form-control" id='cities'>
                                                <option value="{{$alamats->kota}}">{{$alamats->Kota->name}}</option>        
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{$alamats->kode_pos}}" >
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <button type="submit" class="btn btn-success" value="save">Konfirmasi</button>
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                        </div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endforeach


                    
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/city.js') }}"></script>

@endsection


