@extends("layouts.dashboard")

@section("title") Daftar Karyawan @endsection 

@section('pageTitle') Daftar Karyawan @endsection

@section("content")            
            
    
    @if(session('status'))
    <div class="row">
            <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
    </div>
    @endif 
            
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="{{route('users.create')}}" class="btn btn-primary">Tambah Karyawan</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><b>Role</b></th>
                        <th><b>Nama</b></th>
                        <th><b>Email</b></th>
                        <th><b>Telp</b></th>
                        <th><b>Status</b></th>
                        <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->roles}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->telp}}</td>
                            <td>  
                            @if($user->status == "ACTIVE")
                            <span class="badge badge-success">
                                {{$user->status}}
                            </span>
                            @else 
                            <span class="badge badge-danger">
                                {{$user->status}}
                            </span>
                            @endif
                            </td>
                            <td>
                            
                            <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"  action="{{route('users.destroy', ['id' => $user->id ])}}"  method="POST">
                                @csrf
                                <input  type="hidden" name="_method" value="DELETE">
                                <a href="{{route('users.show', ['id' => $user->id])}}" class="btn btn-primary btn-sm mt-1">D</a>
                                <a class="btn btn-info text-white btn-sm mt-1" href="{{route('users.edit', ['id'=>$user->id])}}">E</i></a>
                                <button type="submit" class="btn btn-danger btn-sm mt-1"><i class="fas fa-trash"></i></button>
                            </form>
                            </td>
                        </tr>
                        @endforeach 
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection