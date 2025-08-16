<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        
        // Se validan el email y password, que son los campos que se usan para autenticar
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // COMPROBAR CREDENCIALES QUE SEAN LAS CORRECTAS
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {

            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
