@extends('layouts.app')

@section('module_name', 'Página principal')

@section('content')
<div class="container">

    <style>
        .task-container {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .task-container:hover {
            transform: scale(1.02);
        }

        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .task-animation {
            animation: slideInFromLeft 0.9s ease-out;
        }

        .btn-custom {
            background-color: #535353;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #BEBEBE;
        }

        .btn-eliminar {
            background-color: #BC2332;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-guardar {
            background-color: #318645;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-eliminar:hover {
            background-color: #5F1D1D;
            color: #fff;
        }

        .btn-guardar:hover {
            background-color: #184718;
            color: #fff;
        }

        .input-filter {
            width: 180px;
            padding: 5px;
            border: 0.5px solid #535353;
        }

        .page-container {
            position: relative;
            min-height: 100vh;
        }

        .centered-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }
    </style>

    <div class="d-flex justify-content-center">
        <div class="text-center">
            <form action="{{ url('/filtrar-por-estado') }}" method="POST" class="mb-3 me-3">
                @csrf
                <label for="estado" class="form-label"><strong>Filtrar por Estado:</strong></label>
                <select name="estado" class="form-control input-filter">
                    <option value="">Seleccione un estado</option>
                    <option value="Sin iniciar">Sin iniciar</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Completada">Completada</option>
                    <option value="Anulada">Anulada</option>
                </select>
                <button type="submit" class="btn btn-custom mt-2">Filtrar</button>
            </form>
        </div>

        <div class="text-center">
            <form action="{{ url('/filtrar-por-fecha') }}" method="POST" class="mb-3 me-3">
                @csrf
                <label for="fecha" class="form-label"><strong>Filtrar por Fecha:</strong></label>
                <input type="date" name="fecha" class="form-control input-filter">
                <button type="submit" class="btn btn-custom mt-2">Filtrar</button>
            </form>
        </div>
    </div>

    <div class="container">
        @if ($tareas->isEmpty())

        <div class="centered-message text-center">
            <label><strong>No se encontraron tareas que cumplan con los criterios de filtrado.</strong></label>
        </div>

        @else
        @foreach ($tareas as $tarea)
        @endforeach
        @endif
    </div>
    </section>

    <br>
    <br>

    <div class="d-flex justify-content-between">
        <div>
            <a href="#" class="btn btn-guardar mb-3" data-bs-toggle="modal" data-bs-target="#agregarTareaModal">Agregar tarea</a>
        </div>

        <div>
            <form action="{{ url('/limpiar-filtros') }}" method="GET" class="mb-3 text-end">
                <button type="submit" class="btn btn-custom mt-2">Limpiar filtros</button>
            </form>

        </div>
    </div>

    <div class="table-responsive">
        <table id="table-tareas" class="table mt-3">
            <tbody>
                @forelse ($tareas as $tarea)
                <div class="task-container task-animation">
                    <h4>{{ $tarea->nombre }}</h4>
                    <p><strong>Referencia:</strong> {{ $tarea->referencia }}</p>
                    <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                    <p><strong>Fecha:</strong> {{ $tarea->fecha }}</p>
                    <p><strong>Estado:</strong> {{ $tarea->estado }}</p>
                    <div class="btn-group">
                        <a href="#" class="btn btn-custom editar-tarea" data-id="{{ $tarea->id }}" data-bs-toggle="modal" data-bs-target="#editarTareaModal">Editar</a>
                        <form action="{{ url("/tareas/{$tarea->id}") }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
                @empty

                <div class="text-center">
                    <label style="color: #FFFFFF;"><strong>No hay tareas disponibles</strong></label>
                </div>

                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="agregarTareaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioAgregarTarea" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="referencia" class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="Sin iniciar">Sin iniciar</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Completada">Completada</option>
                                <option value="Anulada">Anulada</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-guardar" onclick="agregarTarea()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarTareaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioEditarTarea" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="referencia_edit" class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="referencia_edit" name="referencia">
                        </div>
                        <div class="mb-3">
                            <label for="nombre_edit" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_edit" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_edit" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion_edit" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_edit" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha_edit" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="estado_edit" class="form-label">Estado</label>
                            <select class="form-control" id="estado_edit" name="estado">
                                <option value="Sin iniciar">Sin iniciar</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Completada">Completada</option>
                                <option value="Anulada">Anulada</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-guardar" onclick="editarTarea()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.editar-tarea').click(function() {
            var tareaId = $(this).data('id');
            $('#editarTareaModal').data('id', tareaId);
            cargarDatosTarea(tareaId);
        });
    });

    function agregarTarea() {

        const referencia = $('#referencia').val();
        const nombre = $('#nombre').val();
        const descripcion = $('#descripcion').val();
        const fecha = $('#fecha').val();
        const estado = $('#estado').val();

        $.ajax({
            url: '/',
            type: 'POST',
            data: {
                referencia: referencia,
                nombre: nombre,
                descripcion: descripcion,
                fecha: fecha,
                estado: estado,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Tarea agregada con éxito');
                $('#agregarTareaModal').modal('hide');
                window.location.reload();
            },
            error: function(xhr, status, error) {
                if (xhr.status == 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Error al agregar tarea:\n';
                    for (let key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('Error al agregar tarea: ' + error);
                }
            }
        });
    }

    function editarTarea() {

        const id = $('#editarTareaModal').data('id');
        console.log("ID de la tarea:", id);
        const referencia = $('#referencia_edit').val();
        const nombre = $('#nombre_edit').val();
        const descripcion = $('#descripcion_edit').val();
        const fecha = $('#fecha_edit').val();
        const estado = $('#estado_edit').val();

        $.ajax({
            url: '/tareas/' + id,
            type: 'PUT',
            data: {
                referencia: referencia,
                nombre: nombre,
                descripcion: descripcion,
                fecha: fecha,
                estado: estado,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Tarea editada con éxito');
                $('#editarTareaModal').modal('hide');
                window.location.reload();
            },
            error: function(xhr, status, error) {
                if (xhr.status == 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Error al agregar tarea:\n';
                    for (let key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('Error al agregar tarea: ' + error);
                }
            }
        });
    }

    function cargarDatosTarea(id) {
        $.ajax({
            url: '/tareas/' + id,
            type: 'GET',
            success: function(response) {
                $('#referencia_edit').val(response.tarea.referencia);
                $('#nombre_edit').val(response.tarea.nombre);
                $('#descripcion_edit').val(response.tarea.descripcion);
                $('#fecha_edit').val(response.tarea.fecha);
                $('#estado_edit').val(response.tarea.estado);
                $('#editarTareaModal').modal('show');
            },
            error: function(xhr, status, error) {
                alert('Error al cargar datos de la tarea: ' + error);
            }
        });
    }
</script>

@endsection