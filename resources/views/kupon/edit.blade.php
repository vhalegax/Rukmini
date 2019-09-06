@extends("layouts.dashboard")

@section("title") Ubah Kupon @endsection 

@section('pageTitle') Ubah Kupon @endsection

@section("content")            
                        
    <div class="card shadow mb-4">
        <div class="card-body">
            <form  action="{{route('kupon.update', ['id' => $kupon->id])}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden"value="PUT"  name="_method">
                <div>
                <label>Nama Kupon</label>
                    <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" type="text" name="name" value="{{old('name') ? old('name') : $kupon->nama}}" required>
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                </div><br>

                <div>
                <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{old('deskripsi') ? old('deskripsi') : $kupon->deskripsi}}</textarea>
                </div><br>

                <div>
                <label>Kode Kupon</label>
                    <input type="text" name="kodekupon" class="form-control {{$errors->first('kodekupon') ? "is-invalid" : ""}}" value="{{old('kodekupon') ? old('kodekupon') : $kupon->kode}}" required>
                    <div class="invalid-feedback">
                        {{$errors->first('kodekupon')}}
                    </div>
                </div><br>

                <div>
                <label>Potongan Harga</label>
                    <input type="number" min="0" name="potongan" class="form-control" value="{{old('potongan') ? old('potongan') : $kupon->potongan}}" required>
                </div><br>

                <div>
                <label>Minimal Pembelian</label>
                    <input type="number" min="0" name="minimalpembelian" class="form-control" value="{{old('minimalpembelian') ? old('minimalpembelian') : $kupon->minimalpembelian}}" required>
                </div><br>

                <div>
                <label>Jumlah Penggunaan</label>
                    <input type="number" min="0" name="jumlah" class="form-control" value="{{old('jumlah') ? old('jumlah') : $kupon->jumlah}}" required>
                </div><br>

                <div>
                <label>Masa Berlaku</label>
                    <input type="date" name="masaberlaku" class="form-control" value="{{old('masaberlaku') ? old('masaberlaku') : $kupon->masa_berlaku}}" required>
                </div><br>


                <input type="submit" class="btn btn-primary" value="Simpan">
                <a href="{{route('kupon.index')}}" class="btn btn-info"> Kembali </a> 

            </form> 
        </div>
    </div>
      
@endsection

@section('footer-scripts') 

<script>tinymce.init({selector:'textarea'});</script>

@endsection