@extends('base')

@section('name')
    Listado de Productos y Servicios Asignados por su(s) Actividad(es) Economica(s)
@endsection

@section('content')
<br>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control, .form-select {
        height: 40px;
        border: 1px solid #ced4da; /* Borde claro */
        border-radius: 4px; /* Bordes redondeados */
    }

    h5.fw-bold {
        margin-bottom: 20px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }

    .row {
        margin-bottom: 10px;
    }

    .btn {
        border: none;
        border-radius: 4px; /* Bordes redondeados */
        padding: 5px 10px; /* Padding para más tamaño */
        font-size: 14px; /* Tamaño de fuente */
        transition: background-color 0.3s, transform 0.2s; /* Efecto al pasar */
    }

    .btn-add {
        background-color: #28a745; /* Verde */
        color: white;
        margin: 0 5px;
    }

    .btn-add:hover {
        background-color: #218838; /* Verde oscuro al pasar */
        transform: scale(1.05); /* Efecto de aumento */
    }

    .btn-icon {
        background-color: #007bff; /* Azul */
        color: white;
    }

    .btn-icon:hover {
        background-color: #0056b3; /* Azul oscuro al pasar */
        transform: scale(1.05);
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        border-bottom: 2px solid #0056b3; /* Borde inferior */
    }

    .modal-title {
        font-weight: bold;
    }

    .modal-content {
        border-radius: 8px; /* Bordes redondeados del modal */
        border: 1px solid #007bff; /* Borde del modal */
    }

    .modal-footer {
        border-top: 1px solid #e9ecef;
    }

    .modal-body {
        padding: 20px;
        background-color: #f8f9fa; /* Fondo más claro */
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 999;
        display: none;
    }

    .spinner-border {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<a data-bs-toggle="modal" data-bs-target="#ModalCrear" class="btn btn-add" role="button">Añadir <i class="fa-regular fa-square-plus"></i></a>
<br>
<br>

<!-- Modal para Crear -->
<div class="modal fade" id="ModalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <font align="center">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar productos o servicios</h1>
                </font>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="message" class="alert alert-success" style="display: none;">Se añadió correctamente</div>
                <form action="{{route('actividad.store')}}" method="POST" onsubmit="showLoader(); setTimeout(hideLoader, 7000); showMessage();">
                    @csrf
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <div class="mb-3">
                        <label class="form-label">Codigo_Producto_SIN</label>
                        <input type="number" class="form-control" name="Codigo_Producto_SIN" id="p_codigo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Codigo_Actividad_CAEB</label>
                        <input type="number" class="form-control" name="Codigo_Actividad_CAEB" id="p_actividad">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion_o_producto_SIN</label>
                        <input type="text" class="form-control" name="Descripcion_o_producto_SIN" id="p_descripcion">
                    </div>
                    
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row mb-3">
                                <div>
                                    <button type="button" class="btn btn-primary btn-lg" id="bt_agregar">
                                        <i class="fas fa-shopping-cart"></i> Agregar
                                    </button>
                                    <br><br>
                                    <table class="coso table-sm">
                                        <thead class="table-primary table-bordered border-primary">
                                            <tr>
                                                <th>Eliminar</th>
                                                <th>Codigo_Producto_SIN</th>
                                                <th>Codigo_Actividad_CAEB</th>
                                                <th>Descripcion_o_producto_SIN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla_body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-auto">
                        <input class="btn btn-primary form-control" type="submit" value="Añadir">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<h5 class="fw-bold">Listado de Actividades econonomicas</h5>
    <table class="table">
        <thead class= >
            <tr>
                <br>
                <th>Codigo_Producto_SIN</th>
                <th>Codigo_Actividad_CAEB</th>
                <th>Descripcion o producto</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
            <tr>
                <td>{{$actividad->Codigo_Producto_SIN}}</td>
                <td>{{$actividad->Codigo_Actividad_CAEB}}</td>
                <td>{{$actividad->Descripcion_o_producto_SIN}}</td>
                <td>
                <form action="{{ route('actividad.destroy', $actividad->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta actividad economica?');">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="btn btn-icon" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta unidad?');">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        
                    </form>
                    <a href="" data-bs-toggle="modal" data-bs-target="#ModalEditar{{ $actividad->id }}" class="btn btn-icon"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a data-bs-toggle="modal" data-bs-target="#ModalMostrar{{ $actividad->id }}" class="btn btn-icon"><i class="fa-solid fa-eye"></i></a>
                </td>
            </tr>

            <!-- MODAL DE EDITAR -->
            <div class="modal fade" id="ModalEditar{{$actividad->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Actividad</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('actividad.update', $actividad->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="codigo_producto_editar" class="form-label">Codigo Producto SIN</label>
                                    <input type="number" class="form-control" id="codigo_producto_editar" name="Codigo_Producto_SIN" value="{{ $actividad->Codigo_Producto_SIN }}">
                                </div>
                                <div class="mb-3">
                                    <label for="codigo_actividad_editar" class="form-label">Codigo Actividad CAEB</label>
                                    <input type="number" class="form-control" id="codigo_actividad_editar" name="Codigo_Actividad_CAEB" value="{{ $actividad->Codigo_Actividad_CAEB }}">
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion_producto_editar" class="form-label">Descripcion o Producto SIN</label>
                                    <input type="text" class="form-control" id="descripcion_producto_editar" name="Descripcion_o_producto_SIN" value="{{ $actividad->Descripcion_o_producto_SIN }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL DE MOSTRAR DETALLES -->
            <div class="modal fade" id="ModalMostrar{{$actividad->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de la Actividad</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label"><strong>Código Producto SIN:</strong></label>
                                <p>{{ $actividad->Codigo_Producto_SIN }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Código Actividad CAEB:</strong></label>
                                <p>{{ $actividad->Codigo_Actividad_CAEB }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Descripción o Producto SIN:</strong></label>
                                <p>{{ $actividad->Descripcion_o_producto_SIN }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
var cont = 0;

function agregar() {
    var codigo = parseInt($("#p_codigo").val());
    var actividad = parseInt($("#p_actividad").val());
    var descripcion = $("#p_descripcion").val().trim();

    if (codigo && actividad && descripcion) {
        if (!isNaN(codigo) && !isNaN(actividad) && descripcion !== "") {
            var fila = '<tr class="selected" id="fila_' + cont + '"><td><button type="button" class="btn btn-danger" onclick="eliminar(event, ' + cont + ')">X</button></td><td style="visibility:collapse; display:none;"><input type="hidden" name="indice[]" value="' + cont + '"></td><td><input type="number" name="Codigo_Producto_SIN[]" value="' + codigo + '"></td><td><input type="number" name="Codigo_Actividad_CAEB[]" value="' + actividad + '"></td><td><input type="text" name="Descripcion_o_producto_SIN[]" value="' + descripcion + '"></td></tr>';
            cont++;
            $('#tabla_body').append(fila);
            // Limpiar los campos de entrada
            $("#p_codigo").val("");
            $("#p_actividad").val("");
            $("#p_descripcion").val("");
        } else {
            alert("Por favor rellene los campos faltantes");
        }
    } else {
        alert("Por favor rellene todos los campos");
    }
}

function eliminar(event, indice) {
    event.preventDefault();
    var fila = $('#fila_' + indice);
    fila.remove();
    cont--;
}

$(document).ready(function() {
    $('#bt_agregar').on('click', agregar);
});
</script>
@endsection
