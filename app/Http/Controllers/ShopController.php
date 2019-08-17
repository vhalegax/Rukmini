<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wishlist;
use App\Pembeli;

class ShopController extends Controller
{
    public function tampilsemua(Request $request)
    {       
           $nama_kategori = 'All Product';
           $group = $request->get('status');
           if(isset($group) && $group === 'diskon')
            {
                $bajus = \App\Baju::where('diskon','>',0)->paginate(25);
            }
            elseif(isset($group) && $group !== 'diskon')
            {  
                $nama_kategori = \App\Kategori::findOrFail($group);

                $bajus = \App\Baju::whereHas('kategori', function ($query) use($group) {
                    $query->where('kategori_id', '=', $group);
                })->paginate(25);
            }
            else
            {
                $bajus = \App\Baju::paginate(25);
            }
            
            $jumlahbaju = \App\Baju::count();
            $kategori = \App\Kategori::all();
            return view('shop.shop',['bajus' => $bajus],['kategori' => $kategori])->with(['nama_kategori' => $nama_kategori])->with(['jumlahbaju' => $jumlahbaju]);
    }

    public function detail($id)
    {
        $baju = \App\Baju::findOrFail($id);
        $kategori = \App\Kategori::paginate(20);
        return view('shop.detail', ['baju' => $baju],['kategoris'=>$kategori]);
    }

    public function home(Request $request)
    {
         return view('shop.home');
    }

}
