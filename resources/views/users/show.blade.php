@extends("layouts.dashboard")

@section("title") Detail Karyawan @endsection 

@section('pageTitle') Detail Karyawan @endsection

@section("content")            
                  
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <b>Nama Lengkap</b><br/><br>
                    <b>Email</b><br><br>
                    <b>No Telp</b><br><br>
                    <b>Alamat</b><br><br>
                    <b>Roles</b><br><br>
                    <b>Gambar </b><br><br>
                </div>
                <div class="col-4 text-left">
                    <b> : {{$user->name}}</b><br><br>
                    <b> : {{$user->email}}</b><br><br>
                    <b> : {{$user->telp}}</b><br><br>
                    <b> : {{$user->alamat}}</b><br><br>
                    <b> : {{$user->roles}}</b><br><br>
                    <b> : @if($user->avatar)
                        <img src="{{asset('storage/'. $user->avatar)}}" width="128px"/>
                        @else 
                        -
                        @endif </b>
                </div>
            </div>

            <hr class="my-3">
            
            <div class="mt-2">
            <a href="{{route('users.edit', ['id'=>$user->id])}}" class="btn btn-info">Ubah</a>
            <a href="{{route('users.index')}}" class="btn btn-primary">Kembali</a>
            </div>
        </form>
        </div>
    </div>
      
@endsection