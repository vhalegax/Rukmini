<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Alamat;
use App\Pembeli;
use App\Province;
use App\City;

class AlamatController extends Controller
{
    public function index(Request $request)
    {
        $id= Auth::guard('pembeli')->user()->id;
        $status = $request->get('status');
        if(isset($status) && $status === 'daftar')
        {
        $province = \App\Province::all();
        $alamat = \App\Pembeli::findOrFail($id);
        return view('pembeli.alamat',['alamat' => $alamat],['province'=>$province]);
        }

        else
        {  
        
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $alamat = new \App\Alamat;
        $alamat->nama = $request->get('nama');
        $alamat->telp = $request->get('telp');
        $alamat->jalan = $request->get('alamat');
        $alamat->kode_pos = $request->get('kode_pos');
        $alamat->kota = $request->get('cities');
        $alamat->provinsi = $request->get('prov');
        $alamat->id_pembeli = Auth::guard('pembeli')->user()->id;
        $alamat->save();
        return redirect()->route('alamat.index',['status'=>'daftar'])->with('info','Berhasil Menambah Alamat');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {         
        $alamat =  \App\Alamat::findOrFail($id);
        $alamat->nama = $request->get('nama');
        $alamat->telp = $request->get('telp');
        $alamat->jalan = $request->get('alamat');
        $alamat->kode_pos = $request->get('kode_pos');
        $alamat->kota = $request->get('cities');
        $alamat->provinsi = $request->get('prov');
        $alamat->id_pembeli = Auth::guard('pembeli')->user()->id;
        $alamat->save();
        return redirect()->route('alamat.index',['status'=>'daftar'])->with('info','Berhasil Merubah Alamat');
    }

    public function destroy($id)
    {
        $alamat = \App\Alamat::findOrFail($id);
        $alamat->delete();
        return redirect()->route('alamat.index',['status'=>'daftar'])->with('info', 'Berhasil Menghapus Alamat');
    }
}
