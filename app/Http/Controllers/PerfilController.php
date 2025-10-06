<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function index() {
        
        return view('perfil.index');
    }

    public function store(Request $request) {

        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            'username' => [
                'required',
                'min:3',
                'max:20',
                'not_in:crear-cuenta,login,logout,posts,imagenes,comentarios,likes,perfil,editar-perfil',
                Rule::unique('users')->ignore(auth()->id())
                // util cuando se quiere que el username sea único, excepto para el usuario autenticado (para que no marque error al dejar el mismo nombre y no diga usuario tomado). Otra forma de hacerlo es con unique:users,username,' . auth()->user()->id
            ],

            'email' => [
                'required',
                'email',
                'max:60',
                Rule::unique('users')->ignore(auth()->id())
            ],
            
            'password' => ['nullable', 'min:6', 'max:20'], // contraseña actual
            'new_password' => ['nullable', 'min:6', 'max:20'], // nueva contraseña
        ]);

        if($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // Guardar la imagen en el servidor
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Ajustar la imagen al tamaño deseado
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Verificar contraseña actual solo si intenta cambiar la contraseña
        // Esto compara la contraseña ingresada con la contraseña almacenada, y da true si la contraseña actual ingresada es incorrecta
        if ($request->new_password && !Hash::check($request->password, auth()->user()->password)) {
            return back()
                ->with('mensaje', 'Contraseña actual incorrecta')
                ->withInput();
        }

        $usuario = User::findOrFail(auth()->id());
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->email = $request->email;

        // Solo cambiar la contraseña si se ingresó una nueva
        if ($request->new_password) {
            $usuario->password = Hash::make($request->new_password);
        }

        $usuario->save();

        // Redireccionar al perfil del usuario
        return redirect()->route('posts.index', $usuario->username);
    }

    public function buscar(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('perfil.buscar', ['mensaje' => null, 'user' => null]);
        }

        $user = \App\Models\User::where('username', 'LIKE', "%{$query}%")->first();

        if ($user) {
            return redirect()->route('posts.index', $user->username);
        }

        return view('perfil.buscar', [
            'mensaje' => "No se encontró ningún usuario con el nombre '{$query}'.",
            'user' => null
        ]);
    }
}
