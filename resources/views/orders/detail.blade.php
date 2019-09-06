@extends("layouts.dashboard")

@section("title") Transaksi @endsection 

@section('pageTitle') Transaksi @endsection

@section("content")            
                  
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <h3>Invoice Pembelian : {{$order->invoice_number}}</h3>
            </div>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('orders.update', ['id' => $order->id])}}" method="POST">
                @csrf

                <input type="hidden"  value="PUT"  name="_method">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                    Petugas <br><br>
                    Nama Pembeli <br><br>
                    Transfer ke <br><br>
                    A/N Transfer <br><br>
                    No Rek Pembeli <br><br>
                    Jam Transfer <br><br>
                    Status Pembelian <br><br>
                    Masukkan No Resi <br><br>
                    </div>
                    <div class="col-6">
                    : {{$order->User->name}} <br><br>
                    : {{$order->Pembeli->nama_lengkap}} <br><br>
                    : {{$order->Bank}} <br><br>
                    : {{$order->AN}} <br><br>
                    : {{$order->Rek}} <br><br>
                    : {{$order->jam_bayar}} <br><br>
                    : {{$order->status}} <br><br>
                    : <input type="text" name="resi" class="form col-6" value="{{$order->no_resi}}">
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Nama Baju</th>
                                        <th>Size</th>
                                        <th>Jumlah</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php foreach($order->Detail_tr_penjualan as $row) :?>
                                        <tr>
                                            <td>{{$row->Baju->nama_baju}}</td>
                                            <td>{{$row->size}}</td>
                                            <td>{{$row->jumlah}}</td>
                                            <td>{{"Rp " . number_format($row->harga,2,',','.')}}</td>
                                            <td>{{"Rp " . number_format($row->subtotal,2,',','.')}}</td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>{{$order->pengiriman->pengiriman}}</th>
                                            <th>{{$letters = preg_replace('/[^a-zA-Z]/', '', $order->pengiriman->service)}}</th>
                                            <th>{{"Rp " . number_format(preg_replace('/[^0-9]/', '', $order->pengiriman->service),2,',','.')}}</th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th><b>Subtotal</B></th>
                                            <td>{{"Rp " . number_format($total = ($row->subtotal)+(preg_replace('/[^0-9]/', '', $order->pengiriman->service)),2,',','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>DiBayar</b></td>
                                            <td>{{"Rp " . number_format($order->jumlah_bayar,2,',','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>Kembalian</b></td>
                                            <td>{{"Rp " . number_format($order->jumlah_bayar-$total,2,',','.')}}</td>
                                        </tr> 
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div> 
                
                @if($order->status=='Menunggu Konfirmasi')
                    <input type="hidden" readOnly class="form-control" name="status" value="Konfirmasi">
                    <button class="btn btn-primary " type="submit" value="save">Konfirmasi Pembelian</button>
                @endif
                    <button class="btn btn-primary" type="submit" value="save">Simpan Perubahan</button>
            </form>
        </div>
    </div>
      
@endsection

