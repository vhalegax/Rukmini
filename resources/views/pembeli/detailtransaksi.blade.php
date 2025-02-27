@extends('layouts.frontend')
@section('title') Detail Pembelian @endsection
@section('content')

    <div style="height:60px;">
        <div class="container">
        </div>
    </div>

    <section class="mt-5">
        <div class="container">

            <div class="profile-pembeli2">
                <a  href="{{route('pembeli.index')}}">Profile</a>
                <a  href="{{route('alamat.index',['status'=>'daftar'])}}" >Daftar Alamat</a>
                <a  href="{{route('cart.index')}}"  >Keranjang Belanjaan</a>
                <a  href="{{route('pakaian.tampil',['status' =>'aktif'])}}">Pembayaran</a>
                <a  href="{{route('pembeli.wishlist')}}">Wishlist</a>
                <a  href="{{route('pembeli.wishlist')}}">Riwayat Transaksi</a>
            </div>


            <div class="row border bingkai">
                <div class="col-xl-12 col-md-12">

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

                    <div class="row" >
                        <div class="col-md-12"><img src="{{asset('frontend/img/rukmini.jpg')}}" alt=""></div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <h6>Invoice Number : <small>{{$order->invoice_number}}</small></h6>
                            <h6>Tgl Pembelian : <small>{{date('d M Y',strtotime($order->created_at))}}</small></h6>
                            <h6>Status : <b>{{$order->status}}</b></h6>
                            <h6>No Resi : <small>{{$order->no_resi}}</small></h6>
                        </div>
                        <div class="col-md-6">
                        <h6>Tujuan Pengiriman : </h6>
                        <p>
                        {{$order->pengiriman->nama_penerima}} <br>
                        {{$order->pengiriman->jalan}} <br>
                        {{$order->pengiriman->Kota->name}} , {{$order->pengiriman->Provinsi->name}}<br>
                        {{$order->pengiriman->telp}}
                        </p>
                        </div>
                    </div><br><br>

                    <div class="row" >
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Nama Pakaian</th>
                                            <th>Size</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $temp=0; foreach($order->Detail_tr_penjualan as $row) :?>
                                            <tr>
                                                <td> {{$row->Baju->nama}}</td>
                                                <td class="text-uppercase">{{$row->size}}</td>
                                                <td>{{$row->jumlah}}</td>
                                                <td>{{"Rp " . number_format($row->harga,2,',','.')}}</td>
                                                <td>{{"Rp " . number_format($row->subtotal,2,',','.')}}</td>
                                            </tr>
                                            <?php $temp=$temp+$row->subtotal; endforeach;?>
                                    </tbody>
                                    
                                    <tfoot>
                                        <tr>
                                            <td colspan="8">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Berat</th>
                                            <th>Pegiriman</th>
                                            <th>Servis</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                            <tr>
                                                <td>{{$order->pengiriman->berat/1000}} Kg</td>
                                                <td class="text-uppercase">{{$order->pengiriman->pengiriman}}</td>
                                                <td>{{$letters = preg_replace('/[^a-zA-Z]/', '', $order->pengiriman->service)}}</td>
                                                <td>{{"Rp " . number_format($numbers = preg_replace('/[^0-9]/', '', $order->pengiriman->service),2,',','.')}}</td>
                                            </tr>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="8">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Potongan Kupon</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                            <tr>
                                                <td>{{"Rp " . number_format(($order->potongankupon),2,',','.')}}</td>
                                            </tr>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="8">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Total Invoice</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                            <tr>
                                                <td>{{"Rp " . number_format($numbers = ($temp)+($order->ongkir)-($order->potongankupon),2,',','.')}}</td>
                                            </tr>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="8">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        @if($order->status=="Menunggu Konfirmasi")
                            <a class="btn btn-dark mt-1" href="{{route('checkout.konfirmasi',['id'=>$order->id])}}">Ubah</a>
                        @else
                            <a class="btn btn-dark mt-1" href="{{route('checkout.konfirmasi',['id'=>$order->id])}}">Konfirmasi Pembayaran</a>
                        @endif
                            <button class="btn btn-outline-dark mt-1" type="submit">Simpan PDF</button>
                            <a class="btn btn-outline-dark mt-1" href="{{route('checkout.tampil',['status' =>'5'])}}">Kembali</a>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div> 
    </section>
    <!-- ##### Shop Grid Area End ##### -->

@endsection

@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/time.js') }}"></script>

@endsection