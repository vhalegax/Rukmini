@extends("layouts.dashboard")

@section("title") Edit Kategori @endsection 

@section('pageTitle') Edit Kategori @endsection

@section("content")            
                  
            
    <div class="card shadow mb-4">
      <div class="card-body">
        <form  action="{{route('kategori.update', ['id' => $kategori->id])}}" enctype="multipart/form-data" method="POST">
          @csrf 
          <input type="hidden"value="PUT"  name="_method">
          
          <label>Nama Kategori</label> <br>
          <input  type="text" class="form-control" value="{{$kategori->name}}" name="name">
          <br><br>

          @if($kategori->image)
          <span>Gambar Kategori</span><br>
          <img src="{{asset('storage/'. $kategori->image)}}" width="120px">
          <br><br>
          @endif

          <input type="file"class="form-control" name="image">
          <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
          <br><br>
          
          <input type="submit" class="btn btn-primary" value="Update">

        </form>
      </div>
    </div>
      
@endsection