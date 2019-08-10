@extends("layouts.dashboard")

@section("title") Tambah No Rekening @endsection 

@section('pageTitle') Tambah No Rekening @endsection

@section("content")            
                  
  <div class="card shadow mb-4">
    <div class="card-body">
      <form enctype="multipart/form-data"  action="{{route('bank.store')}}"  method="POST">
        @csrf
        <label>Nama Bank :</label><br>
        <input  type="text"  class="form-control"  name="nama_bank">
        <br>
        <label>Atas Nama :</label><br>
        <input  type="text"  class="form-control"  name="atas_nama">
        <br>
        <label>No Rekening Nama :</label><br>
        <input  type="number"  class="form-control"  name="no_rek">
        <br>
        <label>Logo Bank :</label>
        <input  type="file" class="form-control"  name="image">
        <br>
        <button type="submit" class="btn btn-primary" value="Save">Tambah<button>
        <a href="{{route('bank.index')}}" class="btn btn-info"> Batal </a> 
      </form> 
    </div>
  </div>

@endsection
