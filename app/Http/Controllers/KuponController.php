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

    public function tampil($status)
    {
       $kupon = \App\Kupon::where('status',$status)->get();
       $aktif = \App\Kupon::where('status','aktif')->count();
       $nonaktif = \App\Kupon::where('status','nonaktif')->count();
       return view('kupon.index', ['kupon' => $kupon])->with(['aktif'=>$aktif])->with(['nonaktif'=>$nonaktif]);
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
        "potongan" => "lt:minimalpembelian",
        ])->validate();

        $kupon = new \App\Kupon;
        $kupon->nama = $request->get('name');
        $kupon->deskripsi = $request->get('deskripsi');
        $kupon->kode = $request->get('kodekupon');
        $kupon->potongan = $request->get('potongan');
        $kupon->minimalpembelian = $request->get('minimalpembelian');
        $kupon->masa_berlaku = $request->get('masaberlaku');
        $kupon->jumlah = $request->get('jumlah');
        $kupon->status = "aktif";
        $kupon->created_by = \Auth::user()->id;
        $kupon->save();

        return redirect()->route('kupon.tampil',['status' =>'aktif'])->with('status','Berhasill Menambah Kupon');
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
        "diskon_baju" => "gt:minimalpembelian",
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

        return redirect()->route('kupon.tampil',['status' =>'aktif'])->with('status','Berhasill Menambah Kupon');
    }

    public function destroy($id)
    {   
        $kupon = \App\Kupon::findOrFail($id);
        $tr_penjualan = \App\Tr_penjualan::where('kupon_id','=',$id)->get();
        if(!$tr_penjualan->isEmpty())
        {
            return redirect()->route('kupon.tampil',['status' =>'nonaktif'])->with('status','Kupon Yang Pernah Digunakan Pembeli, Tidak Dapat Di Hapus Permanen');
        }
        else
        {   
            $kupon->delete();
            return redirect()->route('kupon.tampil',['status' =>'nonaktif'])->with('status', 'Kupon Berhasil Dihapus');
        }
    }

    public function nonaktif($id)
    {
        $kupon = \App\Kupon::findOrFail($id);
        $kupon->status = "nonaktif";
        $kupon->save();
        return redirect()->route('kupon.tampil',['status' =>'aktif'])->with('status', 'Kupon Berhasil Di Nonaktifkan');
    }

    public function aktif($id)
    {
        $kupon = \App\Kupon::findOrFail($id);
        $kupon->status = "aktif";
        $kupon->save();
        return redirect()->route('kupon.tampil',['status' =>'nonaktif'])->with('status', 'Kupon Berhasil Di Aktifkan Kembali');
    }

}
