@extends("layouts.dashboard")

@section("title") Ubah Data Karyawan @endsection 

@section('pageTitle') Ubah Data Karyawan @endsection

@section("content")            
                  
            
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
      <form enctype="multipart/form-data" action="{{route('users.update', ['id'=>$user->id])}}" method="POST">

        @csrf

        <input type="hidden" value="PUT" name="_method">

        <label for="name"><b>Nama Lengkap : </b></label>
        <input value="{{$user->name}}" class="form-control col-6" type="text"  name="name" id="name"/>
        <br>

        <label for="email"><b>Email : </b></label>
        <input value="{{$user->email}}" disabled  class="form-control col-6" type="text"  name="email"  id="email"/>
        <br>

        <label for=""><b>Status : </b></label>
        <br/>
        <label for="active">Active </label> <input {{$user->status == "ACTIVE" ? "checked" : ""}}  value="ACTIVE" type="radio"   id="active" name="status">
        <label for="inactive">Inactive </label> <input {{$user->status == "INACTIVE" ? "checked" : ""}} value="INACTIVE"  type="radio"  id="inactive" name="status"> 
        <br><br>

        <label for="">Roles :</label>
        <select class="form-control col-6">
            <option value="volvo">Pilih Role</option>
        </select>
        <br>

        <label for="telp"><b>Nomor Telepon : </b></label> 
        <input type="text" name="telp"  class="form-control col-6" value="{{$user->telp}}">
        <br>

        <label for="avatar"><b>Alamat : </b></label>
        <textarea name="alamat" id="alamat"  class="form-control col-6" value="">{{$user->alamat}}</textarea>
        <br>

        <label for="avatar"><b>Avatar : </b></label>
        @if($user->avatar)
          <img  src="{{asset('storage/'.$user->avatar)}}"  width="120px" />
          <br>
        @endif
        <input   id="avatar"  name="avatar"   type="file"   class="form-control col-6">
        <small  class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

        <hr class="my-3">

        <input  class="btn btn-primary" type="submit" value="Simpan"/>
      </form>
    </div>
  </div>
      
@endsection