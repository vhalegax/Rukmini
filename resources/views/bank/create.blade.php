@extends("layouts.dashboard")

@section("title") Tambah Nomor Rekening @endsection 

@section('pageTitle') Tambah Nomor Rekening @endsection

@section("content")            
                  
  <div class="card shadow mb-4">
    <div class="card-body"> 
      <form enctype="multipart/form-data" action="{{route('bank.store')}}" method="POST">
          @csrf

          <div class="form-row">
              <div class="col-12 mb-3">
                  <label>Nama Bank :</label><br>
                  <input  type="text"  class="form-control"  name="nama_bank">
              </div>
          </div>

          <div class="form-row">
              <div class="col-12 mb-3">
                    <label>Atas Nama :</label><br>
                    <input  type="text"  class="form-control"  name="atas_nama">
              </div>
          </div>

          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <label>Nomor Rekening :</label><br>
                  <input  type="number"  class="form-control"  name="no_rek">
              </div>
          </div>

          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <label>Logo Bank :</label>
                  <input  type="file" class="form-control"  name="image">
              </div>
          </div>

          <button class="btn btn-primary" type="submit" value="save">Tambah</button>
      </form>
    </div>
  </div>

@endsection
