<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KuponController extends Controller
{
    
    public function __construct(){
        $this->middleware(function($request, $next){

        if(Gate::allows('manage-kupon')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        $kupon = \App\Kupon::paginate(10);
        return view('kupon.index', ['kupon' => $kupon]);
    }

    public function create()
    {
        return view('kupon.create');
    }

    public function store(Request $request)
    {   
         \Validator::make($request->all(),[
        "name" => "unique:kupon,nama",
        "kodekupon" => "unique:kupon,kode",
        ])->validate();

        $kupon = new \App\Kupon;
        $kupon->nama = $request->get('name');
        $kupon->deskripsi = $request->get('deskripsi');
        $kupon->kode = $request->get('kodekupon');
        $kupon->potongan = $request->get('potongan');
        $kupon->minimalpembelian = $request->get('minimalpembelian');
        $kupon->masa_berlaku = $request->get('masaberlaku');
        $kupon->jumlah = $request->get('jumlah');
        $kupon->status = "Aktif";
        $kupon->created_by = \Auth::user()->id;
        $kupon->save();

        return redirect()->route('kupon.index')->with('status', 'Berhasil Menambah kupon');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kupon = \App\Kupon::findOrFail($id);
        return view('kupon.edit', ['kupon' => $kupon]);
    }

    public function update(Request $request, $id)
    {
         \Validator::make($request->all(),[
        "name" => "unique:kupon,nama,". $id,
        "kodekupon" => "unique:kupon,kode,". $id,
        ])->validate();

        $kupon = \App\Kupon::findOrFail($id);       
        $kupon->nama = $request->get('name');
        $kupon->deskripsi = $request->get('deskripsi');
        $kupon->kode = $request->get('kodekupon');
        $kupon->potongan = $request->get('potongan');
        $kupon->minimalpembelian = $request->get('minimalpembelian');
        $kupon->masa_berlaku = $request->get('masaberlaku');
        $kupon->jumlah = $request->get('jumlah');
        $kupon->edited_by = \Auth::user()->id;
        $kupon->save();

        return redirect()->route('kupon.index')->with('status', 'Berhasil Ubah kupon');
    }

    public function destroy($id)
    {
        $kupon = \App\Kupon::findOrFail($id);
        $kupon->delete();
        return redirect()->route('kupon.index')->with('status', 'Kupon Berhasil Dihapus');
    }

    public function nonaktif($id)
    {
        $kupon = \App\Kupon::findOrFail($id);
        $kupon->status = "Nonaktif";
        $kupon->save();
        return redirect()->route('kupon.index')->with('status', 'Kupon Berhasil Di Nonaktifkan');
    }

}
