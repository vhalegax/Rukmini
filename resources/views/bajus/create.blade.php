@extends("layouts.dashboard")

@section("title") Tambah Pakaian @endsection 

@section('pageTitle') Tambah Pakaian @endsection

@section("content")       
    <div class="card shadow mb-4">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('pakaian.store')}}"method="POST">
                @csrf

                <div class="form-row">
                    <div class="col-12 mb-3">
                        <label>Nama Pakaian : </label><br>
                        <input type="text" class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" value="{{old('nama')}}" name="nama" required>
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12 mb-3">
                        <label>Deskripsi Pakaian : </label><br>
                        <textarea  name="deskripsi"  id="deskripsi" name="deskripsi" class="form-control">{{old('deskripsi')}}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12 mb-3">
                        <label>Kategori Pakaian : </label><br>
                        <select  multiple="" name="categories[]" id="categories" class="form-control" value="{{old('categories[]')}}" required></select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label>Harga Pakaian : </label><br>
                        <input type="number"  name="harga_baju" class="form-control" value="{{old('harga_baju')}}" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Potongan Harga : </label><br>
                        <input type="number"  name="diskon_baju" class="form-control" value="{{old('diskon_baju')}}" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <label>Jumlah Pakaian : </label><br>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" name="xl" placeholder="XL" min="0" value="{{old('xl')}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" name="l" placeholder="L" min="0" value="{{old('l')}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" name="m" placeholder="M" min="0" value="{{old('m')}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" name="s" placeholder="S" min="0" value="{{old('s')}}">
                    </div>
                </div>

                 <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label>Gambar 1 : </label><br>
                        <input type="file" id="gmbr1" name="gmbr1">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gambar 2 : </label><br>
                        <input type="file" id="gmbr2" name="gmbr2">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gambar 3 : </label><br>
                        <input type="file" id="gmbr3" name="gmbr3">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gambar 4 : </label><br>
                        <input type="file" id="gmbr4" name="gmbr4">
                    </div>
                </div>

                <button class="btn btn-primary" type="submit" value="save">Tambah</button>
                <a href="{{route('pakaian.index')}}" class="btn btn-info"> Kembali </a> 
            </form>
        </div>
    </div>

@endsection

@section('footer-scripts')

<script>tinymce.init({selector:'textarea'});</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
$('#categories').select2({
  ajax: {
   // url: 'http://www.wisnusetyawann.xyz/dashboard/ajax/kategori/search', 
   url: 'http://localhost:8000/dashboard/ajax/kategori/search',
    processResults: function(data){
      return {
        results: data.map(function(item){return {id: item.id, text: item.nama} })
      }
    }
  }
});
</script>
@endsection