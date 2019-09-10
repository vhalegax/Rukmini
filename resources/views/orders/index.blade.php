@extends("layouts.dashboard")

@section("title") Daftar Transaksi @endsection 

@section('pageTitle') Daftar Transaksi @endsection

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
            <a class="nav-link aktif" href="" >Semua (5)</a>
            <a class="nav-link" href="">Menunggu Pembayaran (4)</a>
            <a class="nav-link" href="">Menunggu Konfirmasi (0)</a>
            <a class="nav-link" href="">Proses (0)</a>
            <a class="nav-link" href="">Dikirim (0)</a>
            <a class="nav-link" href="">Selesai (1)</a>
            <a class="nav-link" href="">Batal (0)</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="" class="btn btn-primary">Tambah Transaksi</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><b>Invoice</b></th>
                        <th><b>Total</b></th>
                        <th><b>Status</b></th>
                        <th><b>Tanggal</b></th>
                        <th><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $order)
                        <tr>
                            <td>{{$order->invoice_number}}</td>
                            <td>Rp {{number_format("$order->total",0,",",".")}}</td>
                            <td>{{$order->status}}</td>
                            @php $old_date_timestamp = strtotime($order->created_at) @endphp
                            <td>{{date('d-M-y  H:i', $old_date_timestamp)}}</td>
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('orders.show' ,['id'=> $order->id])}}">Bukti Pembayaran</i></a>
                                <a class="btn btn-success text-white btn-sm" href="{{route('orders.show' ,['id'=> $order->id])}}">Invoice</i></a>
                                <form  class="d-inline"
                                action="{{route('checkout.destroy', ['id' => $order->id , 'user' =>'admin'])}}" method="POST" onsubmit="return confirm('Hapus Pesanan ini?')">
                                @csrf 
                                <input  type="hidden"  value="DELETE"  name="_method">
                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i> </button>
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