@extends("layouts.dashboard")

@section("title") Ubah Nomor Rekening @endsection 

@section('pageTitle') Ubah Nomor Rekening @endsection

@section("content")            
                  
            
    <div class="card shadow mb-4">
      <div class="card-body">
        <form  action="{{route('bank.update', ['id' => $bank->id])}}" enctype="multipart/form-data" method="POST">
          @csrf 
          <input type="hidden"value="PUT"  name="_method">
          
            <label>Nama Bank :</label><br>
            <input  type="text"  class="form-control"  name="nama_bank" value="{{$bank->nama_bank}}">
            <br>

            <label>Atas Nama :</label><br>
            <input  type="text"  class="form-control"  name="atas_nama" value="{{$bank->AtasNama}}">
            <br>

            <label>No Rekening Nama :</label><br>
            <input  type="number"  class="form-control"  name="no_rek" value="{{$bank->NoRek}}">
            <br>

            <label for="gambar">Logo Bank :</label><br>
            @if($bank->img)
                <img  src="{{asset('storage/'.$bank->img)}}" width="120px" /><br>
            @else 
                No Gambar
            @endif
            <small  class="text-muted">Kosongkan jika tidak ingin mengubah baju</small><br> 
            <input  type="file" class="form-control"  name="image">
            <br>

            <button type="submit" class="btn btn-primary" value="Update">Simpan</button>
            <a href="{{route('bank.index')}}" class="btn btn-info"> Batal </a> 
        </form>
      </div>
    </div>
      
@endsection