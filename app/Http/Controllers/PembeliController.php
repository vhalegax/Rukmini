<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pembeli;

class PembeliController extends Controller
{
    
    public function index(Pembeli $pembeli)
    {
        $pembeli = Auth::guard('pembeli')->user();
        return view('pembeli.index', ['pembeli'=>$pembeli]);
    }

    public function create()
    {
        return view("pembeli.create");
    }

    public function store(Request $request)
    {
        $new_pembeli = new \App\Pembeli; 
        $new_pembeli->nama_lengkap = $request->get('first_name') . " " .  $request->get('last_name');
        $new_pembeli->password = \Hash::make($request->get('password'));
        $new_pembeli->email = $request->get('email');
        $new_pembeli->save();

        return redirect()->route('home');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
       
    }

    public function update(Request $request, $id)
    {
        $pembeli = \App\Pembeli::findOrFail($id);

        $pembeli->nama_lengkap = $request->get('name');
        $pembeli->telp = $request->get('telp');

        $pembeli->save();
        return back();
    }

    public function destroy($id)
    {
        //
    }

    public function alamat(Pembeli $pembeli)
    {
        $pembeli = Auth::guard('pembeli')->user();
        return view('pembeli.alamat', ['pembeli'=>$pembeli]);
    }

    public function wishlist()
    {
        return view('pembeli.wishlist');
    }

    public function history(Request $request)
    {
        $order = \App\Tr_penjualan::where('pembeli_id','LIKE', Auth::guard('pembeli')->user()->id)->where('status','LIKE','menunggu_pembayaran')->paginate(10)->sortByDesc('id');;
        return view('pembeli.historytransaksi',['order' => $order]);
    }

    public function lupapass()
    {
        return view('pembeli.lupapass');
    }
}
