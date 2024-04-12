<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class TareasController extends Controller
{
    public function index()
    {
        $tareas = Tareas::all();
        return view('tareas.index', ['tareas' => $tareas]);
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'referencia' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'estado' => 'required',
        ], [
            'referencia.required' => 'El campo referencia es requerido.',
            'nombre.required' => 'El campo nombre es requerido.',
            'descripcion.required' => 'El campo descripción es requerido.',
            'fecha.required' => 'El campo fecha es requerido.',
            'estado.required' => 'El campo estado es requerido.',
        ]);

        $tarea = new Tareas();
        $tarea->fill($request->all());
        $tarea->save();

        return redirect('/')->with('success', 'Tarea agregada correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'referencia' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'estado' => 'required',
        ], [
            'referencia.required' => 'El campo referencia es requerido.',
            'nombre.required' => 'El campo nombre es requerido.',
            'descripcion.required' => 'El campo descripción es requerido.',
            'fecha.required' => 'El campo fecha es requerido.',
            'estado.required' => 'El campo estado es requerido.',
        ]);

        $tarea = Tareas::findOrfail($id);
        $tarea->update($request->all());

        return response()->json(['message' => 'Tarea actualizada correctamente']);
    }

    public function edit($id)
    {
        $tarea = Tareas::findOrFail($id);
        return view('tareas.edit', compact('tarea'));
    }

    public function show($id)
    {
        $tarea = Tareas::findOrFail($id);
        return response()->json(['tarea' => $tarea]);
    }

    public function filtrarPorEstado(Request $request)
    {
        $estado = $request->input('estado');
        $tareasFiltradas = Tareas::where('estado', $estado)->get();
        return view('tareas.index', ['tareas' => $tareasFiltradas]);
    }

    public function filtrarPorFecha(Request $request)
    {
        $fecha = $request->input('fecha');
        $tareasFiltradas = Tareas::where('fecha', $fecha)->get();
        return view('tareas.index', ['tareas' => $tareasFiltradas]);
    }

    public function limpiarFiltros()
    {
        $tareas = Tareas::all();
        return view('tareas.index', compact('tareas'));
    }

    public function tareasEnProceso()
    {
        $tareasEnProceso = Tareas::where('estado', 'En proceso')->get();
        return view('tareas.tareas_en_proceso', ['tareas' => $tareasEnProceso]);
    }


    public function todasLasTareas()
    {
        $tareas = Tareas::all();
        return view('tareas.lista_de_tareas', ['tareas' => $tareas]);
    }

    public function destroy($id)
    {
        $tarea = Tareas::findOrFail($id);
        $tarea->delete();

        return redirect('/')->with('success', 'Tarea eliminada correctamente');
    }
}
