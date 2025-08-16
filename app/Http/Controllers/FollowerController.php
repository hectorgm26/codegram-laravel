<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // El user va a ser la persona que estamos siguiendo
    // Request si tiene la persona que está siguiendo
    public function store(User $user) {

        // attach -> insertar pero en relación muchos a muchos en tablas intermedias, pero que no usan modelos directamente, como por ejemplo relacionar una misma tabla

        // Evitar seguirse a sí mismo
        if ($user->id === auth()->id()) {
            return back();
        }

        // syncWithoutDetaching([auth()->id()]) → agrega el usuario autenticado como seguidor solo si aún no lo sigue.
        // Usamos syncWithoutDetaching() en lugar de attach() para evitar errores de clave duplicada
        // si el usuario ya lo está siguiendo. No elimina otras relaciones existentes.
        $user->followers()->syncWithoutDetaching([auth()->id()]);

        return back();
    }

    // El usuario autenticado quiere dejar de seguir al perfil que está visitando
    public function destroy(User $user) {

        // Evitar acciones sobre uno mismo
        if ($user->id === auth()->id()) {
            return back();
        }

        // Quita el seguidor del usuario, el cual es el usuario autenticado
        $user->followers()->detach(auth()->id());

        return back();
    }

}
