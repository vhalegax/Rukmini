@extends("layouts.dashboard")

@section("title") Edit Baju @endsection 

@section('pageTitle') Edit Baju @endsection

@section("content")            
                  
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    
                </div>

                <div class="card-body">
                <form enctype="multipart/form-data" action="{{route('orders.update', ['id' => $order->id])}}" method="POST">
                        @csrf

                    <input type="hidden"  value="PUT"  name="_method">

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">Petugas :</label>
                            <input type="text" class="form-control"  value="{{$order->User->name}}"  readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">Nama Pembeli :</label>
                            <input type="text" class="form-control" value="{{$order->Pembeli->nama_lengkap}}"  readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">Invoice Number :</label>
                            <input type="text" class="form-control" value="{{$order->invoice_number}}"  readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">Transfer ke :</label>
                            <input type="text" readOnly class="form-control" value="{{$order->Bank}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">A/N Transfer :</label>
                            <input type="text" readOnly class="form-control" value="{{$order->AN}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">No Rek Pembeli :</label>
                            <input type="text" readOnly class="form-control" value="{{$order->Rek}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">Jam Transfer :</label>
                            <input type="text" readOnly class="form-control" value="{{$order->jam_bayar}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">Status Pembelian : </label> 
                            <input type="text" readOnly class="form-control" value="{{$order->status}}">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="deskripsi">Masukkan No Resi :</label>
                            <input type="text" class="form-control" name="resi" value="{{$order->no_resi}}">
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

