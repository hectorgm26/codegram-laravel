@extends('layouts.app')

@section('titulo', 'Buscar Usuario')

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6 rounded-lg">
            <form method="GET" action="{{ route('perfil.buscar') }}">
                <label for="q" class="block text-gray-600 font-bold mb-2 uppercase text-sm">
                    Buscar usuario
                </label>

                <input
                    id="q"
                    name="q"
                    type="text"
                    placeholder="Ingresa el nombre de usuario..."
                    class="border p-3 w-full rounded-lg bg-white mb-3"
                    value="{{ request('q') }}"
                />

                <button
                    type="submit"
                    class="bg-sky-600 hover:bg-sky-700 text-white uppercase font-bold px-4 py-2 rounded-lg w-full transition-colors">
                    Buscar
                </button>
            </form>

            @if(isset($mensaje))
                <p class="mt-5 text-center text-red-600 font-semibold">{{ $mensaje }}</p>
            @endif
        </div>
    </div>
@endsection
