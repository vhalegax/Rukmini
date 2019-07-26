@extends("layouts.dashboard")

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
$('#categories').select2({
    ajax: {
        //url: 'http://www.wisnusetyawann.xyz/karyawan/ajax/kategori/search', 
        url: 'http://localhost:8000/karyawan/ajax/kategori/search',
        processResults: function(data){
        return {
            results: data.map(function(item){return {id: item.id, text: item.name} })
        }
        }
    }
});

var categories = {!! $baju->kategori !!}

    categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
        });
</script>
@endsection

@section("title") Edit Baju @endsection 

@section('pageTitle') Edit Baju @endsection

@section("content")     
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                
            </div>
            <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('bajus.update', ['id' => $baju->id])}}" method="POST">
                    @csrf

                <input type="hidden"  value="PUT"  name="_method">

                <div class="form-row">
                    <div class="col-md-12 mb-4">
                        <label for="deskripsi">Nama Baju :</label>
                        <input type="text" class="form-control" id="nama_baju" name="nama_baju" placeholder="Nama Baju"  value="{{$baju->nama_baju}}"  required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-4">
                        <label for="deskripsi">Deskripsi Gambar :</label>
                        <textarea  name="deskripsi"  id="deskripsi" name="deskripsi" class="form-control" placeholder="Deskripsi Baju">{{$baju->deskripsi}}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-4">
                        <label for="deskripsi">Kategori Baju :</label>
                        <select  multiple="" name="categories[]" id="categories" class="form-control">
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    
                    <div class="col-md-12 mb-4">
                    <label for="gambar">Gambar 1 :</label>
                    <br>
                    @if($baju->gambar1)
                    <img  src="{{asset('storage/'.$baju->gambar1)}}" width="120px" />
                    <br>
                    @else 
                        No Gambar
                    @endif
                    <small  class="text-muted">Kosongkan jika tidak ingin mengubah baju</small>
                    <br> 
                    <div class="row">
                        <div class="col-md-4"> <input   id="gmbr1"   name="gmbr1"    type="file"  class="form-control"> </div>
                    </div>
                    </div>

                    <div class="col-md-12 mb-4">
                    <label for="gambar">Gambar 2 :</label>
                    <br>
                    @if($baju->gambar2)
                    <img  src="{{asset('storage/'.$baju->gambar2)}}" width="120px" />
                    <br>
                    @else 
                        No Gambar
                    @endif
                    <small  class="text-muted">Kosongkan jika tidak ingin mengubah baju</small>
                    <br> 
                    <div class="row">
                        <div class="col-md-4"> <input   id="gmbr2"   name="gmbr2"    type="file"  class="form-control"> </div>
                    </div>
                    </div>

                    <div class="col-md-12 mb-4">
                    <label for="gambar">Gambar 3 :</label>
                    <br>
                    @if($baju->gambar3)
                    <img  src="{{asset('storage/'.$baju->gambar3)}}" width="120px" />
                    <br>
                    @else 
                        No Gambar
                    @endif
                    <small  class="text-muted">Kosongkan jika tidak ingin mengubah baju</small>
                    <br> 
                    <div class="row">
                        <div class="col-md-4"> <input   id="gmbr3"   name="gmbr3"    type="file"  class="form-control"> </div>
                    </div>
                    </div>

                    <div class="col-md-12 mb-4">
                    <label for="gambar">Gambar 4 :</label>
                    <br>
                    @if($baju->gambar4)
                    <img  src="{{asset('storage/'.$baju->gambar4)}}" width="120px" />
                    <br>
                    @else 
                        No Gambar
                    @endif
                    <small  class="text-muted">Kosongkan jika tidak ingin mengubah baju</small>
                    <br> 
                    <div class="row">
                        <div class="col-md-4"> <input   id="gmbr4"   name="gmbr4"    type="file"  class="form-control"> </div>
                    </div>
                    </div>

                </div>


                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="gambar">Harga Baju :</label>
                        <input type="number"  name="harga_baju"  id="harga_baju" class="form-control" placeholder="Harga Baju" value="{{$baju->harga}}" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="gambar">Diskon Baju :</label>
                        <input type="number"  name="diskon_baju"  id="diskon_baju" class="form-control" placeholder="Diskon Baju" value="{{$baju->diskon}}" required>
                    </div>
                </div>
            
            

            <div class="form-row">
                <div class="col-md-12 ">
                    <label for="gambar">Jumlah Baju :</label>
                </div>
                
                @foreach($baju->jumlah as $jumlahs)
                <div class="col-md-3 mb-4">
                <small  class="text-muted"> Ukuran {{$jumlahs->size}} : </small>
                <input type="number" class="form-control" id="{{$jumlahs->size}}" name="{{$jumlahs->size}}" placeholder="{{$jumlahs->size}}" value="{{$jumlahs->jumlah}}">
                
                </div>
                @endforeach
            </div>
            <br>                      
                <button class="btn btn-primary" type="submit" value="save">Simpan Perubahan</button>
                <a href="{{route('bajus.index')}}" class="btn btn-info"> Batal </a> 
            </form>
            </div>
        
    </div>
      
@endsection

