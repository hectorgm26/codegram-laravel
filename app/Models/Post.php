<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user() {
        
        // Con select evitamos cargar la consulta con información innecesaria
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios() {
        return $this->hasMany(Comentario::class)->orderBy('created_at', 'desc');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user) {

        // Recorre los likes del post y comprueba si el user_id del like coincide con el id del usuario autenticado, para evitar que un usuario pueda dar más de un like a un mismo post
        return $this->likes->contains('user_id', $user->id);
    }
}
