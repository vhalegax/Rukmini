@extends("layouts.dashboard")

@section("title") Tambah Karyawan @endsection 

@section('pageTitle') Tambah Karyawan @endsection

@section("content")            
                   
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>

            <div class="card-body">
            <form  enctype="multipart/form-data" action="{{route('users.store')}}"   method="POST">
            @csrf

            <input type="hidden" name="status" value="ACTIVE"/>
        
            <label for="name"><b>Nama Lengkap : </b></label>
            <input class="form-control col-12" placeholder="Masukkan Nama Lengkap" type="text"   name="name"  id="name"/>
            <br>

            <label for="email"><b>Email : </b></label>
            <input class="form-control col-12" placeholder="Masukkan Email" type="text" name="email" id="email"/>
            <br>

            <label for="password"><b>Password : </b></label>
            <input  class="form-control col-12"  placeholder="Masukkan Password" type="password" name="password"  id="password"/>
            <br>

            <label for="password_confirmation"><b>Konfirmasi Password :</b></label>
            <input class="form-control col-12" placeholder="Masukkan Konfirmasi Password" type="password"  name="password_confirmation"/>
            <br>

            <label for="role"><b>Role : </b></label>
              <select class="form-control col-12">
                  <option value="volvo">Pilih Role</option>
              </select>
            <br>

            <label for="telp"><b>Nomor Telepon : </b></label> 
            <br>
            <input type="text" name="telp" class="form-control col-12" placeholder="Masukkan Nomor Telepon">

            <br>
            <label for="alamat"><b>Alamat : </b></label>
            <textarea  name="alamat"  id="alamat" class="form-control col-12" placeholder="Masukkan Alamat"></textarea>

            <br>
            <label for="avatar"><b>Avatar : </b></label>
            <br>
            <input  id="avatar" name="avatar" type="file" class="form-control col-12">

            <hr class="my-3">

            <input class="btn btn-primary" type="submit"  value="Tambah"/>
            <a href="{{route('rekening.index')}}" class="btn btn-info"> Kembali </a> 
            </form>
            </div>
    </div>
      
@endsection