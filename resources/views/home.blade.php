@extends('layouts.dashboard')
@section("title") Home @endsection
@section('content')


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
                        </div>
                        <div class="card-body">
                        <h5 class="text-center">
                        You are logged in!
                        </h5>
                        </div>
                </div>
@endsection
