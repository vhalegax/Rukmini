@extends("layouts.dashboard")

@section("title") Tambah Kategori @endsection 

@section('pageTitle') Tambah Kategori @endsection

@section("content")            
                  
  <div class="card shadow mb-4">
    <div class="card-body">
      <form enctype="multipart/form-data"  action="{{route('kategori.store')}}"  method="POST">
        @csrf
        <label>Nama Kategori : </label><br>
        <input  type="text"  class="form-control col-12  {{$errors->first('nama') ? "is-invalid" : ""}}"  name="nama" value="{{old('name')}}" required>
        <div class="invalid-feedback">
          {{$errors->first('nama')}}
        </div>
        <br>

        <label>Deskripsi Kategori : </label><br>
        <textarea name="deskripsi" cols="30" rows="10" class="form-control col-12">{{old('deskripsi')}}</textarea>
        <br>
        
        <label>Gambar : </label><br>
        <input  type="file" name="image" value="{{old('image')}}"><br><br>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </form> 
    </div>
  </div>

@endsection

@section('footer-scripts') 

<script>tinymce.init({selector:'textarea'});</script>

@endsection