@extends("layouts.dashboard")

@section("title") Detail Pakain @endsection 

@section('pageTitle') Detail Pakain @endsection

@section("content")      
    <div class="card shadow mb-4">
      <div class="card-body">
        <b>Nama Pakain :</b><br>
        {{$baju->nama_baju}}<br><br>

        <b>Deskripsi Pakain :</b><br>
          {{$baju->deskripsi}}<br><br>

        <b>Kategori Pakain :</b><br>
          @foreach($baju->kategori as $kategori)
            <li>{{$kategori->name}}</li>
          @endforeach<br>

        <b>Harga Pakain : </b><br>
          {{$baju->harga}}<br><br>

        <b>Diskon : </b><br>
          {{$baju->diskon}}<br><br>

        <b>Di Masukkan Oleh : </b> <br>
          {{$pembuat}}<br><br>

        <b>Di Masukkan Tanggal : </b> <br>
          {{$baju->created_at}}<br><br>

        <b>Update Terakhir Oleh : </b> <br>
          {{$pengedit}}<br><br>

        <b>Update Terakhir Tanggal : </b> <br>
          {{$baju->updated_at}}<br><br>

        <b>Jumlah :</b> <br>
          @foreach($baju->jumlah as $jumlahs)
            {{strtoupper($jumlahs->size)}} : {{$jumlahs->jumlah}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          @endforeach<br><br>

        <b>Gambar :</b><br><br>
        <div class="row">
            <div class="col-3">
                <img src="{{asset('storage/'. $baju->gambar1)}}" width="150px" height="150px"/>
            </div>
            <div class="col-3 ">
              <img src="{{asset('storage/'. $baju->gambar2)}}" width="150px" height="150px"/> 
            </div>
            <div class="col-3 ">
              <img src="{{asset('storage/'. $baju->gambar3)}}" width="150px" height="150px"/> 
            </div>
            <div class="col-3 ">
              <img src="{{asset('storage/'. $baju->gambar4)}}" width="150px" height="150px"/> 
            </div>
        </div>
        <br><br>

        <a href="{{route('bajus.index')}}" class="btn btn-primary btn-sm">Kembali</a>
        <a href="{{route('bajus.edit', ['id' => $baju->id])}}" class="btn btn-info btn-sm"> Ubah </a>

        <form  class="d-inline"
            action="{{route('bajus.destroy', ['id' => $baju->id])}}"
            method="POST"
            onsubmit="return confirm('Move category to trash?')">

            @csrf 

            <input  type="hidden"  value="DELETE"  name="_method">
            <input  type="submit"  class="btn btn-danger btn-sm"   value="Hapus">
        </form>
      </div>
    </div>
      
@endsection