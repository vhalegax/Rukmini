@extends("layouts.dashboard")

@section("title") Daftar Order @endsection 

@section('pageTitle') Daftar Order @endsection

@section("content")            
                
@if(session('info'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif 

    <div class="card shadow mb-2 ">
        <div class="submenu">
            <a class="nav-link aktif" href="" >Semua</a>
            <a class="nav-link" href="">Menunggu Pembayaran</a>
            <a class="nav-link" href="">Menunggu Konfirmasi</a>
            <a class="nav-link" href="">Proses</a>
            <a class="nav-link" href="">Dikirim</a>
            <a class="nav-link" href="">Selesai</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="" class="btn btn-primary">Tambah Order</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><b>Invoice</b></th>
                        <th><b>Total</b></th>
                        <th><b>Dibayar</b></th>
                        <th><b>Status</b></th>
                        <th><b>Tanggal</b></th>
                        <th><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $order)
                        <tr>
                            <td>{{$order->invoice_number}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->jumlah_bayar}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('orders.show' ,['id'=> $order->id])}}">Detail</i></a>
                                <form  class="d-inline"
                                action="{{route('checkout.destroy', ['id' => $order->id , 'user' =>'admin'])}}" method="POST" onsubmit="return confirm('Hapus Pesanan ini?')">
                                @csrf 
                                <input  type="hidden"  value="DELETE"  name="_method">
                                <input  type="submit"  class="btn btn-outline-danger btn-sm" value="Hapus Pesanan">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
@endsection