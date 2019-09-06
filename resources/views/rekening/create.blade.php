@extends("layouts.dashboard")

@section("title") Tambah Rekening @endsection 

@section('pageTitle') Tambah Rekening @endsection

@section("content")            
                  
  <div class="card shadow mb-4">
    <div class="card-body"> 
      <form enctype="multipart/form-data" action="{{route('rekening.store')}}" method="POST">
          @csrf

          <div class="form-row">
              <div class="col-12 mb-3">
                  <label>Jenis Rekening :</label><br>
                  <input type="text" class="form-control" name="nama" value="{{old('nama')}}" required>
              </div>
          </div>

          <div class="form-row">
              <div class="col-12 mb-3">
                    <label>Atas Nama :</label><br>
                    <input  type="text"  class="form-control"  name="AN" value="{{old('AN')}}" required>
              </div>
          </div>

          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <label>Nomor Rekening :</label><br>
                  <input  type="number" min="0" class="form-control {{$errors->first('no_rek') ? "is-invalid" : ""}}"  name="no_rek" value="{{old('no_rek')}}" required>
                   <div class="invalid-feedback">
                    {{$errors->first('no_rek')}}
                   </div>
              </div>
          </div>

          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <label>Gambar :</label>
                  <input  type="file" class="form-control"  name="image">
              </div>
          </div>

          <button class="btn btn-primary" type="submit" value="save">Tambah</button>
          <a href="{{route('rekening.index')}}" class="btn btn-info"> Kembali </a> 
      </form>
    </div>
  </div>

@endsection
