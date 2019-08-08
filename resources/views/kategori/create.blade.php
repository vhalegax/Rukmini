@extends("layouts.dashboard")

@section("title") Tambah Kategori @endsection 

@section('pageTitle') Tambah Kategori @endsection

@section("content")            
                  
  <div class="card shadow mb-4">
    <div class="card-body">
      <form enctype="multipart/form-data"  action="{{route('kategori.store')}}"  method="POST">
        @csrf
        <label>Nama kategori</label><br>
          <input  type="text"  class="form-control"  name="name">
          <br>
          <label>Gambar</label>
          <input  type="file" class="form-control"  name="image">
          <br>
          <input type="submit" class="btn btn-primary" value="Save">
      </form> 
    </div>
  </div>

@endsection
