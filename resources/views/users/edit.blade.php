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
        <input value="{{$user->name}}" class="form-control col-12" type="text"  name="name" id="name"/>
        <br>

        <label for="email"><b>Email : </b></label>
        <input value="{{$user->email}}" disabled  class="form-control col-12" type="text"  name="email"  id="email"/>
        <br>

        <label for="password"><b>Password : </b></label>
        <input  class="form-control col-12"  placeholder="Masukkan Password" type="password" name="password"  id="password"/>
        <br>

        <label for="password_confirmation"><b>Konfirmasi Password :</b></label>
        <input class="form-control col-12" placeholder="Masukkan Konfirmasi Password" type="password"  name="password_confirmation"/>
        <br>

        <label for="">Roles :</label>
        <select class="form-control col-12">
            <option value="volvo">Pilih Role</option>
        </select>
        <br>

        <label for="telp"><b>Nomor Telepon : </b></label> 
        <input type="text" name="telp"  class="form-control col-12" value="{{$user->telp}}">
        <br>

        <label for="avatar"><b>Alamat : </b></label>
        <textarea name="alamat" id="alamat"  class="form-control col-12" value="">{{$user->alamat}}</textarea>
        <br>

        <label for="avatar"><b>Avatar : </b></label>
        @if($user->avatar)
          <br><img  src="{{asset('storage/'.$user->avatar)}}"  width="200px" /><br><br>
          <input type="checkbox" name="hapus_gambar" value="1"> Centang Untuk Menghapus Gambar<br>
        @endif
        <input   id="avatar"  name="avatar"   type="file"   class="form-control col-12 mt-3">
        <small  class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

        <hr class="my-3">

        <input  class="btn btn-primary" type="submit" value="Simpan"/>
        <a href="{{route('users.index')}}" class="btn btn-info"> Kembali </a> 
      </form>
    </div>
  </div>
      
@endsection