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

            <input   type="hidden"  name="status" value="ACTIVE"/>

            <label for="name">Name</label>
            <input   class="form-control" placeholder="Full Name" type="text"   name="name"  id="name"/>
            <br>

            <label for="username">Username</label>
            <input class="form-control" placeholder="username" type="text" name="username" id="username"/>
            <br>

            <label for="password">Password</label>
            <input  class="form-control"  placeholder="password" type="password" name="password"  id="password"/>
            <br>

            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control" placeholder="password confirmation" type="password"  name="password_confirmation" id="password_confirmation"/>
            <br>

            <label for="email">Email</label>
            <input class="form-control" placeholder="user@mail.com" type="text" name="email" id="email"/>
            <br>

            
            <label for="role">Role</label>
            <input class="form-control" value="2" type="text" name="roles" id="roles" />
            <br>

            <!-- <label for="">Roles</label>
            <br>
            <input type="checkbox" name="roles" id="2" value="2"> 
              <label for="2">Admin</label>

            <input type="checkbox" name="roles" id="3" value="3"> 
              <label for="3">Staff</label>

            <input  type="checkbox" name="roles" id="4" value="4"> 
              <label for="4">Kasir</label>
            <br> -->

            <br>
            <label for="telp">No Telp</label> 
            <br>
            <input type="text" name="telp" class="form-control">

            <br>
            <label for="alamat">Alamat</label>
            <textarea  name="alamat"  id="alamat" class="form-control"></textarea>

            <br>
            <label for="avatar">Avatar image</label>
            <br>
            <input  id="avatar" name="avatar" type="file" class="form-control">

            <hr class="my-3">

            <input class="btn btn-primary" type="submit"  value="Save"/>
            </form>
            </div>
    </div>
      
@endsection