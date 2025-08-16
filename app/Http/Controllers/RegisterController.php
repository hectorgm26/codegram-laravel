<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    // Por convencion la ruta que muestra una vista se llama index
    public function index () {
        return view('auth.register');
    }

    public function store(Request $request) {
        // dd($request);
        //dd($request->get('name'));

        // Modificar el request para que el username sea un slug, es decir, que no tenga espacios y todo en minusculas, remplaza espacios por guiones. Asi abajo solo se usa $request->username 
        $request->request->add(['username' => Str::slug($request->username)]);

        // VALIDACION - $this->validate() SE QUITO EN LARAVEL 9
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // AUTENTICAR AL USUARIO llenando el objeto de autenticacion
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        // Otra forma de autenticar al usuario
        auth()->attempt($request->only('email', 'password'));

        // REDIRECCIONAR AL USUARIO
        return redirect()->route('posts.index', auth()->user()->username);
    }

}
