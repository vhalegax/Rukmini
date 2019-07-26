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

    public function index(Request $request)
    {
        $status = $request->get('status');
        if(isset($status) && $status != NULL)
        {
        $bajus = \App\Baju::where('diskon','>',0)->paginate(10);
        }
        else
        {
        $bajus = \App\Baju::paginate(10);
        }
        return view('bajus.index',['bajus' => $bajus]);
    }

    public function create()
    {
        return view('bajus.create');
    }

    public function store(Request $request)
    {
        $new_baju = new \App\Baju;
        $new_baju->nama_baju = $request->get('nama_baju');
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
            $new_jumlah->id_baju =$id_baju;
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
            $new_jumlah->id_baju =$id_baju;
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
            $new_jumlah->id_baju =$id_baju;
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
            $new_jumlah->id_baju =$id_baju;
            $new_jumlah->save();
        }

        return redirect()->route('bajus.index')->with('status','Berhasil Menambah Baju Baru');
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
        $baju = \App\Baju::findOrFail($id);
        $baju->nama_baju = $request->get('nama_baju');
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
        return redirect()->route('bajus.index')->with('status','Berhasil Rubah Baju');
    }

    public function destroy($id)
    {
        $baju = \App\Baju::findOrFail($id);
        $baju->delete();
        return redirect()->route('bajus.index')->with('status', 'Book moved to trash');
    }

    public function trash()
    {
        $bajus = \App\Baju::onlyTrashed()->paginate(10);
        return view('bajus.trash', ['bajus' => $bajus]);
    }

    public function restore($id)
    {
        $bajus = \App\Baju::withTrashed()->findOrFail($id);
        if($bajus->trashed())
        {
            $bajus->restore();
            return redirect()->route('bajus.index')->with('status', 'Bajus successfully restored');
        }
        else 
        {
            return redirect()->route('bajus.trash')->with('status', 'Book is not in trash');
        }
    }

    public function deletePermanent($id)
    {
        $baju = \App\Baju::withTrashed()->findOrFail($id);
        if(!$baju->trashed())
        {
            return redirect()->route('bajus.trash')->with('status', 'Baju is not in trash!')->with('status_type', 'alert');
        } 
        else 
        {
            $baju->jumlah()->forceDelete();
            $baju->forceDelete();
            return redirect()->route('bajus.trash')->with('status', 'Baju permanently deleted!');
        }
    }
}
