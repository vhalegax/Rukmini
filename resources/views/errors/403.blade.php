@extends('layouts.frontend')

@section('content')
<div class="d-flex flex-row justify-content-center error">
  <div class="col-md-12 col-sm-12 col-xm-12 col-lg-6 text-center">
    <div class="Alert alert-danger" style="height:200px; padding-top:60px;">
      <h2>403</h2>
      <h6 class="text-UPPERCASE">{{$exception->getMessage()}}</h6>
    </div>
  </div>
</div>
@endsection