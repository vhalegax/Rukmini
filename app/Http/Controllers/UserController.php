<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = \App\User::paginate(10);
        $filterKeyword = $request->get('keyword');

        if($filterKeyword){
            $users = \App\User::where('email', 'LIKE', "%$filterKeyword%");
         }
        
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view("users.create");
    }

    public function store(Request $request)
    {
        $new_user = new \App\User; 
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->password = \Hash::make($request->get('password'));
        $new_user->roles = $request->get('roles');
        $new_user->alamat = $request->get('alamat');
        $new_user->telp = $request->get('telp');
        $new_user->email = $request->get('email');
        $new_user->status = $request->get('status');
        if($request->file('avatar')){
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar = $file;
        }
        
        $new_user->save();
        return redirect()->route('users.index')->with('status', 'Berhasil Menambah Karyawan');
    }

    public function show($id)
    {
        $user = \App\User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = \App\User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = \App\User::findOrFail($id);
        $user->name = $request->get('name');
        $user->alamat = $request->get('alamat');
        $user->telp = $request->get('telp');
        $user->status = $request->get('status');

        if($request->file('avatar') != NULL){
            if($user->avatar && file_exists(storage_path('app/public/' . $user->avatar)))
            {
                \Storage::delete('public/'.$user->avatar); 
            }
            
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
            
            }
    
        $user->save();
        return redirect()->route('users.index', ['id' => $id])->with('status', 'Berhasil Rubah Karyawan');
    }

    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Berhasil Menghapus Karyawan');
    }

    public function home()
    {
        return view('home');
    }
}
