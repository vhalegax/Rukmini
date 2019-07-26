@extends("layouts.dashboard")

@section("title") Edit Karyawan @endsection 

@section('pageTitle') Edit Karyawan @endsection

@section("content")            
                  
            
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
            <form
        enctype="multipart/form-data"
        action="{{route('users.update', ['id'=>$user->id])}}" method="POST">

        @csrf

        <input type="hidden" value="PUT" name="_method">

        <label for="name">Name :</label>
        <input value="{{$user->name}}"class="form-control" type="text" placeholder="Full Name" name="name" id="name"/>
        <br>

        <label for="username">Username :</label>
        <input  value="{{$user->username}}" disabled class="form-control" placeholder="username" type="text" name="username" id="username"/>
        <br>

        <label for="email">Email :</label>
        <input value="{{$user->email}}" disabled  class="form-control" placeholder="user@mail.com" type="text"  name="email"  id="email"/>
          <br>

        <label for="">Status :</label>
        <br/>
        <label for="active">Active </label> <input {{$user->status == "ACTIVE" ? "checked" : ""}}  value="ACTIVE" type="radio"   id="active" name="status"> <br>
        <label for="inactive">Inactive </label> <input {{$user->status == "INACTIVE" ? "checked" : ""}} value="INACTIVE"  type="radio"  id="inactive" name="status"> 
        <br><br>

        <label for="">Roles :</label>
        <br>
        <input type="checkbox" {{($user->roles) ? "checked" : ""}}  name="roles" id="2" value="2"> 
        
        <label for="2">Admin</label>
        <br>

        <br>
        <label for="telp">No Telp :</label> 
        <br>
        <input type="text" name="telp"  class="form-control"   value="{{$user->telp}}">

        <br>
        <label for="alamat">Alamat :</label>
        <textarea name="alamat" id="alamat"  class="form-control" value="">{{$user->alamat}}</textarea>
        <br>

        <label for="avatar">Avatar image :</label>
        <br>
        @if($user->avatar)
          <img  src="{{asset('storage/'.$user->avatar)}}"  width="120px" />
          <br>
        @else 
          No avatar
        @endif
        <br>
        <input   id="avatar"  name="avatar"   type="file"   class="form-control">
        <small  class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

        <hr class="my-3">

        <input  class="btn btn-primary" type="submit" value="Save"/>
      </form>
    </div>
    </div>
      
@endsection