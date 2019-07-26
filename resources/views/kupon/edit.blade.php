@extends("layouts.dashboard")

@section("title") Tambah Kupon @endsection 

@section('pageTitle') Tambah Kupon @endsection

@section("content")            
                  
            
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
            <form  action="{{route('kupon.update', ['id' => $kupon->id])}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div>
            <input type="hidden"value="PUT"  name="_method">
        
             <label>Nama Kupon</label>
                <input class="form-control" type="text" name="name" value="{{$kupon->nama_kupon}}">
            </div><br>

            <div>
             <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{$kupon->deskripsi}}</textarea>
            </div><br>

            <div>
             <label>Kode Kupon</label>
                <input type="text" name="kodekupon" class="form-control" value="{{$kupon->kode_kupon}}">
            </div><br>

            <div>
             <label>Potongan Harga</label>
                <input type="number" name="potongan" class="form-control" value="{{$kupon->potongan}}">
            </div><br>

            <div>
             <label>Minimal Pembelian</label>
                <input type="number" name="minimalpembelian" class="form-control" value="{{$kupon->minimalpembelian}}">
            </div><br>

            <div>
             <label>Masa Berlaku</label>
                <input type="date" name="masaberlaku" class="form-control" value="{{$kupon->masa_berlaku}}">
            </div><br>

            <div>
             <label>Jumlah Penggunaan</label>
                <input type="number" name="jumlah" class="form-control" value="{{$kupon->jumlah}}">
            </div><br>

              <input type="submit" class="btn btn-primary" value="Save">
              </form> 
            </div>
    </div>
      
@endsection
