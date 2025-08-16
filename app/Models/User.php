<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    // SE PONEN QUE VALORES SE PUEDEN INSERTAR EN LA BD
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    // Metodo que almacena los seguidores de un usuario - saliendonos de las convenciones de Laravel
    public function followers() {

        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); // followers sera la tabla en donde se almacenan los seguidores
        // en user_id va el id del usuario que está siendo seguido, y en follower_id va el id del usuario que sigue, es decir, donde se encontraran las referencias
        // Este usuario tendra el metodo de followers y va a insertar en la tabla followers tanto user_id como el follower_id
    }

    // Metodo para almacenar los que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
        // en este caso, el follower_id es el id del usuario que sigue, y el user_id es el id del usuario que está siendo seguido, por tanto se invierten
    }

    // Comprobar si un usuario ya sigue a otro
    public function siguiendo()
    {
        return $this->followers()
            ->where('follower_id', auth()->id())
            ->exists();
    }
}
