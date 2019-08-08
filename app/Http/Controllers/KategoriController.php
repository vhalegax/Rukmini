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

    public function kategori()
    {
        return view('index');
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
            $name = $request->get('name');
            
            $kategori_baru = new \App\Kategori;
            $kategori_baru->name = $name;

            if($request->file('image'))
            {
                $gambar_kategori = $request->file('image')->store('gambar_kategori', 'public');
                
                $kategori_baru->image = $gambar_kategori;
            }

            $kategori_baru->created_by = \Auth::user()->id;
            $kategori_baru->slug = str_slug($name, '-');
            $kategori_baru->save();

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
            $name = $request->get('name');
            $slug = $request->get('slug');
            $category = \App\Kategori::findOrFail($id);       
            $category->name = $name;
            $category->slug = $slug;
        
            if($request->file('image'))
            {
                if($category->image && file_exists(storage_path('app/public/' . $category->image)))
                {
                    \Storage::delete('public/' . $category->name);
                }
                $new_image = $request->file('image')->store('kategori_image', 'public');
                $category->image = $new_image;
            }
        
            $category->updated_by = \Auth::user()->id;
            $category->slug = str_slug($name);
            $category->save();
            return redirect()->route('kategori.index', ['id' => $id])->with('status', 'Kategori Berhasil Di Update');
    }

    public function destroy($id)
    {
        $category = \App\Kategori::findOrFail($id);
        $category->delete();
        return redirect()->route('kategori.index')->with('status', 'Kategori Berhasil Di Pindahkan Ketempat Sampah');
    }

    public function trash()
    {
        $deleted_category = \App\Kategori::onlyTrashed()->paginate(10);
        return view('kategori.trash', ['kategori' => $deleted_category]);
    }

    public function restore($id)
    {
        $category = \App\Kategori::withTrashed()->findOrFail($id);

        if($category->trashed())
        {
            $category->restore();
        } 
        else 
        {
            return redirect()->route('kategori.index')->with('status', 'Category is not in trash');
        }
        
        return redirect()->route('kategori.index')->with('status', 'Category successfully restored');
    }

    public function deletePermanent($id)
    {
        $category = \App\Kategori::withTrashed()->findOrFail($id);

        if(!$category->trashed())
        {
            return redirect()->route('kategori.index')->with('status', 'Can not delete permanent active category');
        } 
        else 
        {
            $category->forceDelete();
            return redirect()->route('kategori.index')->with('status', 'Category permanently deleted');
        }
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = \App\Kategori::where("name", "LIKE", "%$keyword%")->get();
        return $categories;
    }
}
