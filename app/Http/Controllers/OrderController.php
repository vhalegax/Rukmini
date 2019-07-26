<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    
    public function __construct(){
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-order')) return $next($request);
              abort(403, 'Anda tidak memiliki cukup hak akses');
          });
    }

    public function index()
    {
        $order = \App\Tr_penjualan::paginate(10)->sortByDesc('id');;
        return view('orders.index',['order' => $order]);
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
        $order = \App\Tr_penjualan::findOrFail($id);
        return view('orders.detail', ['order' => $order]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $no_resi=$request->get('resi');
        $status=$request->get('status');
        $selesai =$request->get('selesai');

        if(isset($status) && $status =="Konfirmasi")
        {
            $user = \App\Tr_penjualan::findOrFail($id);
            $user->status = 'Proses';
            $user->save();
            return redirect()->route('orders.index')->with(['info'=>'Berhasil Mengkonfirmasi Pembayaran']);
        }

        elseif(!empty($no_resi))
        {
            $user = \App\Tr_penjualan::findOrFail($id);
            $user->status = 'Pengiriman';
            $user->no_resi = $no_resi;
            $user->save();
            return redirect()->route('orders.index')->with(['info'=>'Berhasil Menambahkan No Resi']);
        }
    }

    public function destroy($id)
    {
        //
    }
}
