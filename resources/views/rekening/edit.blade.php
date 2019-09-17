@extends("layouts.dashboard")

@section("title") Ubah Rekening @endsection 

@section('pageTitle') Ubah Rekening @endsection

@section("content")            
                  
            
    <div class="card shadow mb-4">
      <div class="card-body">
        <form  action="{{route('rekening.update', ['id' => $rekening->id])}}" enctype="multipart/form-data" method="POST">
          @csrf 
          <input type="hidden"value="PUT"  name="_method">
          
            <label>Jenis Rekening :</label><br>
            <input type="text" class="form-control" name="nama" value="{{old('nama') ? old('nama') : $rekening->nama}}" required>
            <br>

            <label>Atas Nama :</label><br>
            <input  type="text"  class="form-control"  name="AN" value="{{old('AN') ? old('AN') : $rekening->AN}}" required>
            <br>

           <label>Nomor Rekening :</label><br>
            <input  type="number" min="0" class="form-control {{$errors->first('no_rek') ? "is-invalid" : ""}}"  name="no_rek" value="{{old('no_rek') ? old('no_rek') : $rekening->nomor}}" required>
            <div class="invalid-feedback">
              {{$errors->first('no_rek')}}
            </div>
            <br>

            <label for="gambar">Gambar :</label><br>
            @if($rekening->gambar)
                <img  src="{{asset('storage/'.$rekening->gambar)}}" width="200px" /><br>
                <input type="checkbox" name="hapus_gambar" value="1"> Centang Untuk Menghapus Gambar<br><br>
            @else 
                No Gambar
            @endif
            <small  class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small><br> 
            <input  type="file" class="form-control"  name="image">
            <br>

            <button type="submit" class="btn btn-primary" value="Update">Simpan</button>
            <a href="{{route('rekening.tampil',['status' =>'aktif'])}}" class="btn btn-info"> Kembali </a>
        </form>
      </div>
    </div>
      
@endsection