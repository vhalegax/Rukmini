@extends('layouts.body')

@section('content')
<div class="d-flex flex-row justify-content-center" style="height:500px; padding-top:150px;">
  <div class="col-md-6 text-center">
    <div class="Alert alert-danger" style="height:200px; padding-top:50px;">
      <h1>403</h1>
      <h4 class="text-UPPERCASE">{{$exception->getMessage()}}</h4>
    </div>
  </div>
</div>
@endsection