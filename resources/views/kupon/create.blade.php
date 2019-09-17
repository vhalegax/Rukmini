@extends("layouts.dashboard")

@section("title") Tambah Kupon @endsection 

@section('pageTitle') Tambah Kupon @endsection

@section("content")      

    <div class="card shadow mb-4">
        <div class="card-body">
            <form enctype="multipart/form-data"  action="{{route('kupon.store')}}"  method="POST">
            @csrf
            <div>
            <label>Nama Kupon</label>
                <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" type="text" name="name" value="{{old('name')}}" required>
                 <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
            </div><br>

            <div>
            <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{old('deskripsi')}}</textarea>
            </div><br>

            <div>
            <label>Kode Kupon</label>
                <input type="text" name="kodekupon" class="form-control {{$errors->first('kodekupon') ? "is-invalid" : ""}}" value="{{old('kodekupon')}}" required>
                <div class="invalid-feedback">
                    {{$errors->first('kodekupon')}}
                </div>
            </div><br>

            <div>
            <label>Potongan Harga</label>
                <input type="number" min="0" name="potongan" class="form-control {{$errors->first('potongan') ? "is-invalid" : ""}}"  value="{{old('potongan')}}" required>
                <div class="invalid-feedback">
                    {{$errors->first('potongan')}}
                </div>
            </div><br>

            <div>
            <label>Minimal Pembelian</label>
                <input type="number" min="0" name="minimalpembelian" class="form-control" value="{{old('minimalpembelian')}}" required>
            </div><br>

            <div>
            <label>Jumlah Penggunaan</label>
                <input type="number" min="0" name="jumlah" class="form-control" value="{{old('jumlah')}}" required>
            </div><br>

            <div>
            <label>Masa Berlaku</label>
                <input type="date" name="masaberlaku" class="form-control" value="{{old('masaberlaku')}}" required>
            </div><br>

            <input type="submit" class="btn btn-primary" value="Tambah">
            <a href="{{route('kupon.tampil',['status' =>'aktif'])}}" class="btn btn-info"> Kembali </a> 

            </form> 
        </div>
    </div>
@endsection

@section('footer-scripts') 

<script>tinymce.init({selector:'textarea'});</script>

@endsection