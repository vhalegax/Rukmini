<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {       
        return view('kasir.index',['bajus' => $data]);
    }

    public function create()
    {
        $bajus = \App\Baju::paginate(10);
        return view('kasir.create',['bajus' => $bajus]);
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        return $id;
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
