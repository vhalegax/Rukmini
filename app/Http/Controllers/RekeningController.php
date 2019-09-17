<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RekeningController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next)
        {
            if(Gate::allows('manage-rekening')) return $next($request);
                abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function tampil($status)
    {
       $rekening = \App\Rekening::where('status',$status)->get();
       $aktif = \App\Rekening::where('status','aktif')->count();
       $nonaktif = \App\Rekening::where('status','nonaktif')->count();
       return view('rekening.index', ['rekening' => $rekening])->with(['aktif'=>$aktif])->with(['nonaktif'=>$nonaktif]);
    }


    public function index()
    {
        $rekening = \App\Rekening::paginate(10);
        return view('rekening.index', ['rekening' => $rekening]);
    }

    public function create()
    {
        return view('rekening.create');
    }

    public function store(Request $request)
    {   
        \Validator::make($request->all(),[
        "no_rek" => "unique:rekening,nomor",
        ])->validate();

        $rekening = new \App\Rekening;
        $rekening->nama = $request->get('nama');
        $rekening->AN = $request->get('AN');
        $rekening->nomor = $request->get('no_rek');
        $rekening->status = 'aktif';

        if($request->file('image'))
        {
            $logo_bank = $request->file('image')->store('rekening', 'public');
            
            $rekening->gambar = $logo_bank;
        }

        $rekening->save();

        return redirect()->route('rekening.tampil',['status' =>'aktif'])->with('status', 'Rekening Baru Berhasil Di Buat');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rekening = \App\Rekening::findOrFail($id);
        return view('rekening.edit', ['rekening' => $rekening]);
    }

    public function update(Request $request, $id)
    {   
        \Validator::make($request->all(),[
        'no_rek' => 'unique:rekening,nomor,' . $id,
        ])->validate();

        $rekening = \App\Rekening::findOrFail($id);

         if($request->get('hapus_gambar') == 1)
        {
            if($rekening->gambar && file_exists(storage_path('app/public/' . $rekening->gambar)))
            {
                \Storage::delete('public/' . $rekening->gambar);
                $rekening->gambar = NULL;
            }
        }

        $rekening->nama = $request->get('nama');
        $rekening->AN = $request->get('AN');
        $rekening->nomor = $request->get('no_rek');

        if($request->file('image'))
        {
            if($rekening->gambar && file_exists(storage_path('app/public/' . $rekening->gambar)))
            {
                \Storage::delete('public/' . $rekening->gambar);
            }
            $logo_bank = $request->file('image')->store('rekening', 'public');
            $rekening->gambar = $logo_bank;
        }

        $rekening->save();
        return redirect()->route('rekening.tampil',['status' =>'aktif'])->with('status', 'Rekening Berhasil Di Ubah');
    }

    public function destroy($id)
    {   
        $rekening = \App\Rekening::findOrFail($id);
        $tr_penjualan = \App\Tr_penjualan::where('rekening_id','=',$id)->get();
        if(!$tr_penjualan->isEmpty())
        {
            return redirect()->route('rekening.tampil',['status' =>'nonaktif'])->with('status','Rekening Yang Pernah Digunakan Untuk Transaksi Pembelian, Tidak Dapat Di Hapus Permanen');
        }
        else
        {
            if($rekening->gambar && file_exists(storage_path('app/public/' . $rekening->gambar)))
            {
                \Storage::delete('public/' . $rekening->gambar);
            }
            $rekening->delete();
            return redirect()->route('rekening.tampil',['status' =>'nonaktif'])->with('status', 'Rekening Berhasil Dihapus');
        }
    }

    public function nonaktif($id)
    {
        $kupon = \App\Rekening::findOrFail($id);
        $kupon->status = "nonaktif";
        $kupon->save();
        return redirect()->route('rekening.tampil',['status' =>'aktif'])->with('status', 'Rekening Berhasil Di Nonaktifkan');
    }

    public function aktif($id)
    {
        $kupon = \App\Rekening::findOrFail($id);
        $kupon->status = "aktif";
        $kupon->save();
        return redirect()->route('rekening.tampil',['status' =>'nonaktif'])->with('status', 'Rekening Berhasil Di Aktifkan Kembali');
    }
}
