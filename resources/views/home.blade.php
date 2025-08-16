@extends('layouts.app')

@section('titulo', 'Página Principal') {{-- Agregar contenido en una sola línea  --}}

@section('contenido')

    <x-listar-post :posts="$posts" />

@endsection