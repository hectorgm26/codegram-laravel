<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {

        // Obtener a quienes seguimos (su id, para filtrar los posts)
        // pluck es para obtener un array con un dato específico que queremos de una colección
        $ids = auth()->user()->followings->pluck('id')->toArray();

        // WhereIn verifica que un valor contenga en su columna los valores de un array, mientras que where busca un valor específico
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', compact('posts'));
    }
}
