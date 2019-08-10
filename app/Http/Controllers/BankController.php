<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BankController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next)
        {
            if(Gate::allows('manage-bank')) return $next($request);
                abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        $bank = \App\Bank::paginate(10);
        return view('bank.index', ['bank' => $bank]);
    }

    public function create()
    {
        return view('bank.create');
    }

    public function store(Request $request)
    {
        $bank = new \App\Bank;
        $bank->nama_bank = $request->get('nama_bank');
        $bank->AtasNama = $request->get('atas_nama');
        $bank->NoRek = $request->get('no_rek');

        if($request->file('image'))
        {
            $logo_bank = $request->file('image')->store('logo_bank', 'public');
            
            $bank->img = $logo_bank;
        }

        $bank->save();

        return redirect()->route('bank.index')->with('status', 'No Rek Baru Berhasil Dibuat');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $bank = \App\Bank::findOrFail($id);
        return view('bank.edit', ['bank' => $bank]);
    }

    public function update(Request $request, $id)
    {
        $bank = \App\Bank::findOrFail($id);
        $bank->nama_bank = $request->get('nama_bank');
        $bank->AtasNama = $request->get('atas_nama');
        $bank->NoRek = $request->get('no_rek');

        if($request->file('image'))
        {
            $logo_bank = $request->file('image')->store('logo_bank', 'public');
            
            $bank->img = $logo_bank;
        }

        $bank->save();
        return redirect()->route('bank.index')->with('status', 'No Rek Berhasil Di Update');
    }

    public function destroy($id)
    {
        $bank = \App\Bank::findOrFail($id);
        $bank->delete();
        return redirect()->route('bank.index')->with('status', 'No Rek Berhasil Dihapus');
    }
}
