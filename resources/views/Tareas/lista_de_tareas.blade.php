@extends('layouts.app')

@section('module_name', 'Lista de Tareas')

@section('content')

<br>
<br>

<div class="container">

    <div class="list-group">
        @forelse ($tareas as $tarea)
        <div class="list-group-item list-group-item-action rounded-3 shadow-sm mb-3">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $tarea->nombre }}</h5>
                <small>{{ $tarea->fecha }}</small>
            </div>
            <p class="mb-1">{{ $tarea->descripcion }}</p>
            <small><strong>Referencia: {{ $tarea->referencia }} | Estado: {{ $tarea->estado }}</strong></small>
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

    .list-group-item {
        border: 1px solid rgba(0, 0, 0, 0.125);
        background-color: #f8f9fa;
    }

    .list-group-item:hover {
        background-color: #e9ecef;
    }
</style>

@endsection