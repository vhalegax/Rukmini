<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KategoriController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next)
        {
            if(Gate::allows('manage-kategori')) return $next($request);
                abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        $kategori = \App\Kategori::paginate(10);
        return view('kategori.index', ['kategori' => $kategori]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        \Validator::make($request->all(),[
        "nama" => "unique:kategori|min:5|max:100",
        ])->validate();

        $kategori = new \App\Kategori;
        $kategori->nama = $request->get('nama');
        $kategori->deskripsi = $request->get('deskripsi');

        if($request->file('image'))
        {
            $gambar_kategori = $request->file('image')->store('gambar_kategori', 'public');
            
            $kategori->gambar = $gambar_kategori;
        }

        $kategori->created_by = \Auth::user()->id;
        $kategori->save();

        return redirect()->route('kategori.index')->with('status', 'Kategori Berhasil Di Buat');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category_to_edit = \App\Kategori::findOrFail($id);
        return view('kategori.edit', ['kategori' => $category_to_edit]);
    }

    public function update(Request $request, $id)
    {   
         \Validator::make($request->all(),[
        'nama' => 'min:5|max:100|unique:kategori,nama,' . $id,
        ])->validate();
           
        $kategori = \App\Kategori::findOrFail($id);  

        if($request->get('hapus_gambar') == 1)
        {
            if($kategori->gambar && file_exists(storage_path('app/public/' . $kategori->gambar)))
            {
                \Storage::delete('public/' . $kategori->gambar);
                $kategori->gambar = NULL;
            }
        }

        $kategori->nama = $request->get('nama');
        $kategori->deskripsi = $request->get('deskripsi');

        if($request->file('image'))
        {   
            if($kategori->gambar && file_exists(storage_path('app/public/' . $kategori->gambar)))
            {
                \Storage::delete('public/' . $kategori->gambar);
            }
            $gambar_kategori = $request->file('image')->store('gambar_kategori', 'public');
            $kategori->gambar = $gambar_kategori;
        }

        $kategori->updated_by = \Auth::user()->id;
        $kategori->save();
        return redirect()->route('kategori.index', ['id' => $id])->with('status', 'Kategori Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $category = \App\Kategori::findOrFail($id);
        $kategori_digunakan = \App\Kategori_Baju::where('kategori_id','=',$id)->get();
        
        if(!$kategori_digunakan->isEmpty())
        {
            return redirect()->route('kategori.index')->with('status','Kategori Yang Sedang Di Gunakan Oleh Pakaian, Tidak Dapat Dipindahkan Ke Tempat Sampah');
        }
        else
        {   
            if($category->gambar && file_exists(storage_path('app/public/' . $category->gambar)))
            {
                \Storage::delete('public/' . $category->gambar);
                $kategori->gambar = NULL;
            }
            $category->delete();
            return redirect()->route('kategori.index')->with('status', 'Kategori Berhasil Di Hapus');
        }
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = \App\Kategori::where("nama", "LIKE", "%$keyword%")->get();
        return $categories;
    }
}
