<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        $personas = Persona::all();
        return view('usuarios', ['usuarios' => $usuarios, 'personas' => $personas]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'min:6',
            'password_confirm' => 'required_with:password|same:password|min:6'
        ]);
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('usuarios')->with('success', 'Usuario creado');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_persona)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'password' => 'min:6',
            'password_confirm' => 'required_with:password|same:password|min:6'
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        return redirect()->route('usuarios')->with('success', 'Usuario creado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
