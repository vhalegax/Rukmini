@extends("layouts.dashboard")

@section("title") Ubah Kategori @endsection 

@section('pageTitle') Ubah Kategori @endsection

@section("content")            
                  
  <div class="card shadow mb-4">
    <div class="card-body">
      <form  action="{{route('kategori.update', ['id' => $kategori->id])}}" enctype="multipart/form-data" method="POST">
        @csrf 
        <input type="hidden"value="PUT"  name="_method">

        <label>Nama Kategori : </label><br>
        <input  type="text"  class="form-control col-12 {{$errors->first('nama') ? "is-invalid" : ""}}""  name="nama" value="{{old('nama') ? old('nama') : $kategori->nama}}" required>
        <div class="invalid-feedback">
          {{$errors->first('nama')}}
        </div>
        <br>

        <label>Deskripsi Kategori : </label><br>
        <textarea name="deskripsi" cols="30" rows="10" class="form-control col-12">{{old('deskripsi') ? old('deskripsi') : $kategori->deskripsi}}</textarea>
        <br>
        
        <label>Gambar : </label><br>
        @if($kategori->gambar)
        <img src="{{asset('storage/'. $kategori->gambar)}}" width="300px"><br><br>
        <input type="checkbox" name="hapus_gambar" value="1"> Centang Untuk Menghpapus Gambar<br><br>
        @endif
        <input  type="file" name="image"><br><br>
        <input type="submit" class="btn btn-primary" value="Simpan">
      </form> 
    </div>
  </div>

@endsection

@section('footer-scripts') 

<script>tinymce.init({selector:'textarea'});</script>

@endsection         
                   