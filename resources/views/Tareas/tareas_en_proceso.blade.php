@extends('layouts.app')

@section('module_name', 'Tareas en proceso')

@section('content')

<style>
    .centered-content {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        font-weight: bold;
        min-height: 60vh;
        transform: translate(-27%, -50%);
    }
</style>
<br>
<br>
<div class="container">

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($tareas as $tarea)
        <div class="col">
            <div class="card h-100 shadow-sm rounded">
                <div class="card-body">
                    <h5 class="card-title">{{ $tarea->nombre }}</h5>
                    <p class="card-text"><strong>Referencia:</strong> {{ $tarea->referencia }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                    <p class="card-text"><strong>Fecha:</strong> {{ $tarea->fecha }}</p>
                    <p class="card-text"><strong>Estado:</strong> {{ $tarea->estado }}</p>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12">
            <div class="centered-content">
                <label style="color: #000000;"><strong>No hay tareas disponibles...</strong></label>
            </div>
        </div>
        @endforelse

    </div>
    <br>
    <br>
</div>
@endsection