<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);

// Buscar usuarios
Route::get('/buscar', [PerfilController::class, 'buscar'])->name('perfil.buscar');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Cualquier usuario puede ver un post específico
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Agrupación para proteger las rutas
Route::middleware(['auth'])->group(function () {

    // Home Principal
    Route::get('/', HomeController::class)->name('home');

    // Crear posts
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

    // Comentarios
    Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

    // Eliminar posts
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Likes
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
    Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

    // Siguiendo usuarios
    Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
    Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

    // Perfil (solo autenticados)
    Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');
});

// Perfil de usuario (siempre al final para no interceptar otras rutas)
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');