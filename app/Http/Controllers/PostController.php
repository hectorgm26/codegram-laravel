<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

// El usuario para poder utilizar este controlador debe estar autenticado
class PostController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(User $user) {

        $posts = Post::where('user_id', $user->id)->latest()->paginate(12);

        return view('dashboard', compact('user', 'posts'));
    }

    public function create() {
        
        return view('posts.create');
    }

    public function store(Request $request) {
        
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        /* OTRA FORMA DE REALIZAR REGISTROS
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();
        */

        /* OTRA FORMA DE REALIZAR REGISTROS, PERO CON RELACIONES
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen
        ]);
        */

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post) {

        return view('posts.show', compact('post', 'user'));
    }

    public function destroy(Post $post) {

        // Mediante el Policy, se comprueba si el usuario autenticado puede eliminar el post
        $this->authorize('delete', $post);

        $post->delete();

        // Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}