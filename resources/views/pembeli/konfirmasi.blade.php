@extends('layouts.frontend')
@section('title') Belanjaan @endsection
@section('content')

<div class="breadcumb_area bg-img" style="background-image: url({{asset('frontend/img/breadcumb.jpg')}});">
    <div class="container">
        <div class="col-12">
            <div class="text-center center">
            <h2>Konfirmasi Pembayaran</h2>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row border bingkai">
        <div class="col-12 col-md-12 text-center">
            <h5><b>Silahkan Lakukan Pembayaran</b></h5>
            <hr>
            <h5>Total : Rp {{number_format(($orders->total-$orders->potongankupon),2,',','.')}}</h5>
            <hr>
            <h5><b>Metode Pembayaran</b></h5>
            <br>
            @foreach($bank as $banks)
                <div class="row">
                    <div class="col-6  text-right">
                        <img class="img-fluid" src="{{asset('storage/' . $banks->img)}}" style="height:90px; width:220px;">
                    </div>
                    <div class="col-6 text-left">
                        <h6><b>{{$banks->nama_bank}}</b></h5>
                        <h6>{{$banks->NoRek}}</h5>
                        <h6>a/n {{$banks->AtasNama}}</h5>
                    </div>
                </div>
                <br>
            @endforeach
            <hr>
        </div>
        <div class="col-12 col-md-12">
            <form method="POST" enctype="multipart/form-data" action="{{route('checkout.update', ['id' => $orders->id])}}">
            @csrf
                <input type="hidden"  value="PUT"  name="_method">
                <div class="form-group">
                    <label class="control-label">Invoice Number</label>
                    <div>
                        <input readonly type="text" class="form-control input-lg" value="{{$orders->invoice_number}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Tanggal Bayar</label>
                    <div>
                        <input type="date" class="form-control input-lg" name="tanggal_bayar" value="{{$orders->tanggal_bayar}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Jam Bayar</label>
                    <div>
                        <input type="time" class="form-control input-lg" name="jam" value="{{$orders->jam_bayar}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Jumlah Bayar</label>
                    <div>
                        <input type="number" class="form-control input-lg" name="jumlah" value="{{$orders->jumlah_bayar}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Bank Tujuan</label>
                    <div>
                        <select name="bank" id="" class="form-control input-lg">
                        @foreach($bank as $bank1)
                            <option value="{{$bank1->nama_bank}}">{{$bank1->nama_bank}}</option>
                         @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Nama Rek Pengirim</label>
                    <div>
                        <input type="text" class="form-control input-lg" name="AN" value="{{$orders->AN}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Bukti Pembayaran</label>
                    <br>
                    @if($orders->bukti_bayar)
                        <img  src="{{asset('storage/'.$orders->bukti_bayar)}}" width="200px" />
                        <br>
                        <br>
                    @else 
                    @endif
                    <div>
                        <input id="gambar1" name="gambar1" type="file" class="form-control">    
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-success" value="save">Konfirmasi</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal" >Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>








@endsection

@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/time.js') }}"></script>

@endsection