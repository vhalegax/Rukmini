@extends("layouts.dashboard")

@section("title") Edit Karyawan @endsection 

@section('pageTitle') Edit Karyawan @endsection

@section("content")            
                  
            
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
                <b>Name:</b> <br/>
                {{$user->name}}
                <br><br>

                @if($user->avatar)
                <img src="{{asset('storage/'. $user->avatar)}}" width="128px"/>
                @else 
                No avatar
                @endif 

                <br>
                <br>
                <b>Username:</b><br>
                {{$user->username}}

                <br><br>
                <b>Email</b> <br>
                {{$user->email}}

                <br>
                <br>
                <b>No Telp</b> <br>
                {{$user->telp}}

                <br><br>
                <b>Alamat</b> <br>
                {{$user->alamat}}

                <br>
                <br>
                <b>Roles:</b> <br>
                {{$user->roles}}
            </div>
    </div>
      
@endsection