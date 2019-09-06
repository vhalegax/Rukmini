@extends("layouts.dashboard")

@section("title") Ubah Pakaian @endsection 

@section('pageTitle') Ubah Pakaian @endsection

@section("content")     
    <div class="card shadow mb-3">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('pakaian.update', ['id' => $baju->id])}}" method="POST">
                @csrf
                <input type="hidden"  value="PUT"  name="_method">
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="deskripsi">Nama Pakaian :</label>
                        <input type="text" class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" value="{{old('nama') ? old('nama') : $baju->nama}}" name="nama" required>
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="deskripsi">Deskripsi Pakaian :</label>
                        <textarea  name="deskripsi"  id="deskripsi" name="deskripsi" class="form-control" placeholder="Deskripsi Baju" required>{{old('deskripsi') ? old('deskripsi') : $baju->deskripsi}}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12 mb-3">
                        <label for="deskripsi">Kategori Pakaian :</label>
                        <select  multiple="" name="categories[]" id="categories" class="form-control col-12" required>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="gambar">Harga Pakaian :</label>
                        <input type="number"  name="harga_baju"  id="harga_baju" class="form-control" placeholder="Harga Baju" value="{{old('harga_baju') ? old('harga_baju') : $baju->harga}}" required min="0">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="gambar">Diskon Pakaian :</label>
                        <input type="number"  name="diskon_baju"  id="diskon_baju" class="form-control" placeholder="Diskon Baju" value="{{old('diskon_baju') ? old('diskon_baju') : $baju->diskon}}" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <label for="gambar">Jumlah Pakaian :</label>
                    </div>
                    @foreach($baju->jumlah as $jumlahs)
                    <div class="col-md-3 mb-3">
                        <small  class="text-muted"> Ukuran {{$jumlahs->size}} : </small>
                        <input type="number" class="form-control" id="{{$jumlahs->size}}" name="{{$jumlahs->size}}" placeholder="{{$jumlahs->size}}" value="{{old('$jumlahs->size') ? old('$jumlahs->size') : $jumlahs->jumlah}}">
                    </div>
                    @endforeach
                </div><br>

                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="gambar">Gambar 1 :</label><br>
                        @if($baju->gambar1)
                            <img  src="{{asset('storage/'.$baju->gambar1)}}" width="120px" /><br>
                            <input type="checkbox" name="1" value="1">Kosongkan Gambar<br>
                        @else 
                            No Gambar
                        @endif
                        <input   id="gmbr1"   name="gmbr1"    type="file" ><br>
                        <small  class="text-muted">Kosongkan jika tidak ingin mengubah</small><br>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="gambar">Gambar 2 :</label><br>
                        @if($baju->gambar2)
                            <img  src="{{asset('storage/'.$baju->gambar2)}}" width="120px" /><br>
                            <input type="checkbox" name="2" value="2">Kosongkan Gambar<br>
                        @else 
                            No Gambar
                        @endif
                        <input   id="gmbr2"   name="gmbr2"    type="file" ><br>
                        <small  class="text-muted">Kosongkan jika tidak ingin mengubah</small><br>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="gambar">Gambar 3 :</label><br>
                        @if($baju->gambar3)
                            <img  src="{{asset('storage/'.$baju->gambar3)}}" width="120px" /><br>
                            <input type="checkbox" name="3" value="3">Kosongkan Gambar<br>
                        @else 
                            No Gambar
                        @endif
                        <input   id="gmbr3"   name="gmbr3"    type="file" ><br>
                        <small  class="text-muted">Kosongkan jika tidak ingin mengubah</small><br>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="gambar">Gambar 4 :</label><br>
                        @if($baju->gambar4)
                            <img  src="{{asset('storage/'.$baju->gambar4)}}" width="120px" /><br>
                            <input type="checkbox" name="4" value="4">Kosongkan Gambar<br>
                        @else 
                            No Gambar
                        @endif
                        <input   id="gmbr4"   name="gmbr4"    type="file" ><br>
                        <small  class="text-muted">Kosongkan jika tidak ingin mengubah</small><br> 
                    </div>
                </div>

                <button class="btn btn-primary" type="submit" value="save">Simpan</button>
                <a href="{{route('pakaian.index')}}" class="btn btn-info"> Kembali </a> 
            </form>
        </div>
    </div>
      
@endsection

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#categories').select2({
        ajax: {
            //url: 'http://www.wisnusetyawann.xyz/dashboard/ajax/kategori/search', 
            url: 'http://localhost:8000/dashboard/ajax/kategori/search',
            processResults: function(data){
            return {
                results: data.map(function(item){return {id: item.id, text: item.nama} })
            }
            }
        }
    });

    var categories = {!! $baju->kategori !!}
    categories.forEach(function(category)
    {
        var option = new Option(category.nama, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>

<script>tinymce.init({selector:'textarea'});</script>
                   
@endsection

