@extends("layouts.dashboard")

@section("title") Detail Pakain @endsection 

@section('pageTitle') Detail Pakain @endsection

@section("content")      
    <div class="card shadow mb-4">
      <div class="card-body">
        <b>Nama Pakain :</b><br>
        {{$baju->nama}}<br><br>

        <b>Deskripsi Pakain :</b><br>
          {!!$baju->deskripsi!!}<br><br>

        <b>Kategori Pakain :</b><br>
          @foreach($baju->kategori as $kategori)
            <li>{{$kategori->nama}}</li>
          @endforeach<br>

        <b>Harga Pakain : </b><br>
          Rp {{ number_format($baju->harga,0,",",".")}}<br><br>

        <b>Diskon : </b><br>
          Rp {{ number_format($baju->diskon,0,",",".")}}<br><br>

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
              <img src="{{asset('storage/'. $baju->gambar1)}}" width="200px" height="200px"/>
            </div>
            <div class="col-3 ">
              <img src="{{asset('storage/'. $baju->gambar2)}}" width="200px" height="200px"/> 
            </div>
            <div class="col-3 ">
              <img src="{{asset('storage/'. $baju->gambar3)}}" width="200px" height="200px"/> 
            </div>
            <div class="col-3 ">
              <img src="{{asset('storage/'. $baju->gambar4)}}" width="200px" height="200px"/> 
            </div>
        </div>
        <br><br>
        
        <a href="{{route('pakaian.edit', ['id' => $baju->id])}}" class="btn btn-info"> Ubah </a>
        <a href="{{route('pakaian.tampil',['status' =>'aktif'])}}" class="btn btn-primary">Kembali</a>

      </div>
    </div>
      
@endsection