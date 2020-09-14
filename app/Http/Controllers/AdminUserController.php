<?php

namespace App\Http\Controllers;

use App\Foto;
use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $entrada = $request->all();

        if ($archivo = $request->file('ruta_foto')) {
            $nombre = $archivo->getClientOriginalName();
            $archivo->move('images', $nombre);
            $foto = Foto::create(['ruta_foto' => $nombre]);
            $entrada['ruta_foto'] = $foto->id;
        }
        $entrada['password'] = bcrypt($request->password);

        User::create($entrada);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
           
        ]);
        $user = User::findOrFail($id);
        $entrada = $request->all();

        if ($archivo = $request->file('ruta_foto')) {
            $nombre = $archivo->getClientOriginalName();
            $archivo->move('images', $nombre);
            $foto = Foto::create(['ruta_foto' => $nombre]);
            $entrada['ruta_foto'] = $foto->id;
        }

        $user->update($entrada);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->delete()) {

            return redirect('/admin/users');
        } else {
            return redirect('/admin/users');
        }
    }
}
