<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(User $user, Post $post, Request $request) {

        // validar el comentario
        $request->validate([
            'comentario' => 'required|max:255'
        ]);

        // almacenar el comentario
        Comentario::create([
            'user_id' => auth()->user()->id, // es eñ usuario que comenta y que está autenticado
            'post_id' => $post->id, // es el post que estamos viendo y comentando
            'comentario' => $request->comentario
        ]);

        // Imprimir un mensaje de exito
        return back()->with('mensaje', 'Comentario creado correctamente');
    }
}
