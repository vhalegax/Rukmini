<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wishlist;
use App\Pembeli;

class WishlistController extends Controller
{
    public function wishlist($id)
    {
        $wishlist = new \App\Wishlist;
        $wishlist->pembelis_id =  Auth::guard('pembeli')->user()->id;
        $wishlist->bajus_id = $id;
        $wishlist->save();
        return redirect()->route('tampil');
    }

    public function hapuswishlist($id,Request $request)
    {   
        if($request->get('status')=='wishlist')
        {
            $id_pembeli =  Auth::guard('pembeli')->user()->id;
            $wishlist = \App\Wishlist::firstOrFail()->where('bajus_id', $id)->where('pembelis_id',$id_pembeli);
            $wishlist->delete();
            return redirect()->route('pembeli.wishlist');
        }
        else
        {
            $id_pembeli =  Auth::guard('pembeli')->user()->id;
            $wishlist = \App\Wishlist::firstOrFail()->where('bajus_id', $id)->where('pembelis_id',$id_pembeli);
            $wishlist->delete();
            return redirect()->route('tampil');
        }
       
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }
}
