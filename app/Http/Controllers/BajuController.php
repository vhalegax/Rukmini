<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BajuController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next)
        {

        if(Gate::allows('manage-baju')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function tampil($status)
    {   
        if($status=='diskon')
        {
            $pakaian = \App\Baju::where('status','aktif')->where('diskon','>',0)->get();
        }
        else
        {
             $pakaian = \App\Baju::where('status',$status)->get();
        }

        $aktif = \App\Baju::where('status','aktif')->count();
        $nonaktif = \App\Baju::where('status','nonaktif')->count();
        $diskon = \App\Baju::where('diskon','>',0)->count();

        return view('bajus.index', ['bajus' => $pakaian])->with(['aktif'=>$aktif])->with(['nonaktif'=>$nonaktif])->with(['diskon'=>$diskon]);
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        if(isset($status) && $status != NULL)
        {
            $bajus = \App\Baju::where('diskon','>',0)->paginate(30);
        }
        else
        {
            $bajus = \App\Baju::paginate(30);
        }
        return view('bajus.index',['bajus' => $bajus]);
    }

    public function create()
    {
        return view('bajus.create');
    }

    public function store(Request $request)
    {   
        \Validator::make($request->all(),[
        "nama" => "unique:pakaian,nama",
        "diskon_baju" => "lt:harga_baju",
        ])->validate();

        $new_baju = new \App\Baju;
        $new_baju->nama = $request->get('nama');
        $new_baju->deskripsi = $request->get('deskripsi');
        $new_baju->harga = $request->get('harga_baju');
        $new_baju->diskon = $request->get('diskon_baju');

        $gmbr1 = $request->file('gmbr1');
        if($gmbr1)
        {
            $gambar1 = $gmbr1->store('gambar_baju', 'public');
            $new_baju->gambar1 = $gambar1;
        }

        $gmbr2 = $request->file('gmbr2');
        if($gmbr2)
        {
            $gambar2 = $gmbr2->store('gambar_baju', 'public');
            $new_baju->gambar2 = $gambar2;
        }

        $gmbr3 = $request->file('gmbr3');
        if($gmbr3)
        {
            $gambar3 = $gmbr3->store('gambar_baju', 'public');
            $new_baju->gambar3 = $gambar3;
        }

        $gmbr4 = $request->file('gmbr4');
        if($gmbr4)
        {
            $gambar4 = $gmbr4->store('gambar_baju', 'public');
            $new_baju->gambar4 = $gambar4;
        }

        $new_baju->status = "aktif";
        $new_baju->created_by = \Auth::user()->id;
        $new_baju->save();
        $new_baju->kategori()->attach($request->get('categories'));

        $xl=0;
        $l=0;
        $m=0;
        $s=0;

        $id_baju = $new_baju->id;

        if($xl==0)
        {   
            $new_jumlah = new \App\Jumlah;
            $new_jumlah->size='xl';
            if($request->get('xl')>0)
            {
                $xl=$request->get('xl');
            }
            $new_jumlah->jumlah=$xl;
            $new_jumlah->created_by = \Auth::user()->id;
            $new_jumlah->pakaian_id =$id_baju;
            $new_jumlah->save();
        }

        if($l==0)
        {   
            $new_jumlah = new \App\Jumlah;
            $new_jumlah->size='l';
            if($request->get('l')>0)
            {
                $l=$request->get('l');
            }
            $new_jumlah->jumlah=$l;
            $new_jumlah->created_by = \Auth::user()->id;
            $new_jumlah->pakaian_id =$id_baju;
            $new_jumlah->save();
        }

        if($m==0)
        {   
            $new_jumlah = new \App\Jumlah;
            $new_jumlah->size='m';
            if($request->get('m')>0)
            {
                $m=$request->get('m');
            }
            $new_jumlah->jumlah=$m;
            $new_jumlah->created_by = \Auth::user()->id;
            $new_jumlah->pakaian_id =$id_baju;
            $new_jumlah->save();
        }

        if($s==0)
        {   
            $new_jumlah = new \App\Jumlah;
            $new_jumlah->size='s';
            if($request->get('s')>0)
            {
                $s=$request->get('s');
            }
            $new_jumlah->jumlah=$s;
            $new_jumlah->created_by = \Auth::user()->id;
            $new_jumlah->pakaian_id =$id_baju;
            $new_jumlah->save();
        }

        return redirect()->route('pakaian.tampil',['status' =>'aktif'])->with('status','Berhasil Menambah Data Pakaian Baru');
    }

    public function show($id)
    {
        $baju = \App\Baju::findOrFail($id);
        $pengedit = "Belum Pernah Edit";
        $pembuat = \App\User::where('id', $baju->created_by)->pluck('name')->first();
        if($baju->updated_by!==NULL)
        {
            $pengedit = \App\User::where('id', $baju->updated_by)->pluck('name')->first();
        }
        return view('bajus.show', ['baju' => $baju] , ['pembuat'=> $pembuat])->with(['pengedit' => $pengedit]);
    }

    public function edit($id)
    {
        $id_baju_edit = \App\Baju::findOrFail($id);
        return view('bajus.edit', ['baju' => $id_baju_edit]);
    }

    public function update(Request $request, $id)
    {   
         \Validator::make($request->all(),[
        "nama" => "unique:pakaian,nama," . $id,
        "diskon_baju" => "lt:harga_baju",
        ])->validate();

        $baju = \App\Baju::findOrFail($id);

        if($request->get('1') == 1)
        {
            if($baju->gambar1 && file_exists(storage_path('app/public/' . $baju->gambar1)))
            {
                \Storage::delete('public/' . $baju->gambar1);
                $baju->gambar1 = NULL;
            }
        }

        if($request->get('2') == 2)
        {
            if($baju->gambar2 && file_exists(storage_path('app/public/' . $baju->gambar2)))
            {
                \Storage::delete('public/' . $baju->gambar2);
                $baju->gambar2 = NULL;
            }
        }

        if($request->get('3') == 3)
        {
            if($baju->gambar3 && file_exists(storage_path('app/public/' . $baju->gambar3)))
            {
                \Storage::delete('public/' . $baju->gambar3);
                $baju->gambar3 = NULL;
            }
        }

        if($request->get('4') == 4)
        {
            if($baju->gambar4 && file_exists(storage_path('app/public/' . $baju->gambar4)))
            {
                \Storage::delete('public/' . $baju->gambar4);
                $baju->gambar4 = NULL;
            }
        }

        $baju->nama = $request->get('nama');
        $baju->deskripsi = $request->get('deskripsi');
        $baju->harga = $request->get('harga_baju');
        $baju->diskon = $request->get('diskon_baju');

        if($request->file('gmbr1') != NULL)
        {
            if($baju->gambar1 && file_exists(storage_path('app/public/' . $baju->gambar1)))
            {
                \Storage::delete('public/'.$baju->gambar1); 
            }
            $file = $request->file('gmbr1')->store('gambar_baju', 'public');
            $baju->gambar1 = $file;
        }

        if($request->file('gmbr2') != NULL)
        {
            if($baju->gambar2 && file_exists(storage_path('app/public/' . $baju->gambar2)))
            {
                \Storage::delete('public/'.$baju->gambar2); 
            }
            $file = $request->file('gmbr2')->store('gambar_baju', 'public');
            $baju->gambar2 = $file;
        }

        if($request->file('gmbr3') != NULL)
        {
            if($baju->gambar3 && file_exists(storage_path('app/public/' . $baju->gambar3)))
            {
                \Storage::delete('public/'.$baju->gambar3); 
            }
            $file = $request->file('gmbr3')->store('gambar_baju', 'public');
            $baju->gambar3 = $file;
        }

        if($request->file('gmbr4') != NULL)
        {
            if($baju->gambar4 && file_exists(storage_path('app/public/' . $baju->gambar4)))
            {
                \Storage::delete('public/'.$baju->gambar4); 
            }
            $file = $request->file('gmbr4')->store('gambar_baju', 'public');
            $baju->gambar4 = $file;
        }
        
        $baju->updated_by = \Auth::user()->id;
        $baju->save();
        $baju->kategori()->sync($request->get('categories'));
        $baju->jumlah()->where('size','xl')->update(['jumlah' => $request->get('xl') , 'updated_by' => \Auth::user()->id ]);
        $baju->jumlah()->where('size','l')->update(['jumlah' => $request->get('l') , 'updated_by' => \Auth::user()->id ]);
        $baju->jumlah()->where('size','m')->update(['jumlah' => $request->get('m') , 'updated_by' => \Auth::user()->id ]);
        $baju->jumlah()->where('size','s')->update(['jumlah' => $request->get('s') , 'updated_by' => \Auth::user()->id ]);
        return redirect()->route('pakaian.tampil',['status' =>'aktif'])->with('status','Berhasil Ubah Pakaian');
    }

    public function destroy($id)
    {
        $baju = \App\Baju::findOrFail($id);
        $tr_penjualan = \App\Detail_tr_penjualan::where('pakaian_id','=',$id)->get();
        if(!$tr_penjualan->isEmpty())
        {
            return redirect()->route('pakaian.tampil',['status' =>'nonaktif'])->with('status','Pakaian Yang Pernah Dibeli Pembeli, Tidak Dapat Di Hapus Permanen');
        }
        else 
        {   
            if($baju->gambar1 && file_exists(storage_path('app/public/' . $baju->gambar1)))
            {
                \Storage::delete('public/' . $baju->gambar1);
                $baju->gambar1 = NULL;
            }
            if($baju->gambar2 && file_exists(storage_path('app/public/' . $baju->gambar2)))
            {
                \Storage::delete('public/' . $baju->gambar2);
                $baju->gambar2 = NULL;
            }
            if($baju->gambar3 && file_exists(storage_path('app/public/' . $baju->gambar3)))
            {
                \Storage::delete('public/' . $baju->gambar3);
                $baju->gambar3 = NULL;
            }
            if($baju->gambar4 && file_exists(storage_path('app/public/' . $baju->gambar4)))
            {
                \Storage::delete('public/' . $baju->gambar4);
                $baju->gambar4 = NULL;
            }
            $baju->jumlah()->forceDelete();
            $baju->Delete();
            return redirect()->route('pakaian.tampil',['status' =>'nonaktif'])->with('status', 'Pakaian Berhasil Dihapus Permanen!');
        }
    }

    public function nonaktif($id)
    {
        $baju = \App\Baju::findOrFail($id);
        $baju->status = "nonaktif";
        $baju->save();
        return redirect()->route('pakaian.tampil',['status' =>'aktif'])->with('status', 'Pakaian Berhasil Di Nonaktifkan');
    }

    public function aktif($id)
    {
        $baju = \App\Baju::findOrFail($id);
        $baju->status = "aktif";
        $baju->save();
        return redirect()->route('pakaian.tampil',['status' =>'nonaktif'])->with('status', 'Pakaian Berhasil Di Aktifkan Kembali');
    }


}
