@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data">

                @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ session('mensaje') }}
                </p>
                @endif

                @csrf
                    <div class="mb-5">
                        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                            Username
                        </label>
                        <input
                            id="username"
                            name="username"
                            type="text"
                            placeholder="Tu nombre de usuario"
                            class="border p-3 w-full rounded-lg bg-white @error('username') border-red-500 @enderror"
                            value="{{ auth()->user()->username }}"
                        />

                        @error('username')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="Tu Email de Registro"
                            class="border p-3 w-full rounded-lg bg-white @error('email') border-red-500 @enderror"
                            value="{{ auth()->user()->email }}"
                        />

                        @error('email')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                            Imagen Perfil
                        </label>
                        <input
                            id="imagen"
                            name="imagen"
                            type="file"
                            class="border p-3 w-full rounded-lg file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-sky-600 file:text-white
                                hover:file:bg-sky-700"
                            accept=".jpg, .jpeg, .png, .gif, .webp"
                        />
                    </div>

                    <div class="mb-5">
                        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Password Actual a Cambiar
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Tu Password Actual"
                            class="border p-3 w-full rounded-lg bg-white @error('password') border-red-500 @enderror"
                        />

                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- AQUI NO ES PASSWORD_CONFIRMATION, SINO NUEVA PASSWORD --}}
                    <div class="mb-5">
                        <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Ingresa tu nueva Password
                        </label>
                        <input
                            id="new_password"
                            name="new_password"
                            type="password"
                            placeholder="Ingresa tu nueva Password"
                            class="border p-3 w-full rounded-lg bg-white @error('new_password') border-red-500 @enderror"
                        />

                        @error('new_password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <input
                        type="submit"
                        value="Guardar Cambios"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    />

            </form>
        </div>
    </div>
@endsection