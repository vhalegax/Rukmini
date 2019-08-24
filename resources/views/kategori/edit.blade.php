@extends("layouts.dashboard")

@section("title") Ubah Kategori @endsection 

@section('pageTitle') Ubah Kategori @endsection

@section("content")            
                  
            
    <div class="card shadow mb-4">
      <div class="card-body">
        <form  action="{{route('kategori.update', ['id' => $kategori->id])}}" enctype="multipart/form-data" method="POST">
          @csrf 
          <input type="hidden"value="PUT"  name="_method">
          
          <label>Nama Kategori : </label> <br>
          <input  type="text" class="form-control col-4" value="{{$kategori->name}}" name="name" required>
          <br>

          <label>Gambar : </label><br>
          @if($kategori->image)
          <img src="{{asset('storage/'. $kategori->image)}}" width="300px">
          <br><br>
          @endif

          <input type="file" name="image"><br>
          <small class="text-muted mt-1">Kosongkan jika tidak ingin mengubah gambar</small>
          <br><br><br>
          <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
      </div>
    </div>
      
@endsection