@extends('base')

@section('name')
Listado de Unidad(es) de Medida(s)
@endsection

@section('content')

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
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    h5.fw-bold {
        margin-bottom: 20px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }

    .btn {
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        font-size: 14px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-add {
        background-color: #28a745;
        color: white;
        margin: 0 5px;
    }

    .btn-add:hover {
        background-color: #218838;
        transform: scale(1.05);
    }

    .btn-icon {
        background-color: #007bff;
        color: white;
    }

    .btn-icon:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        border-bottom: 2px solid #0056b3;
    }

    .modal-title {
        font-weight: bold;
    }

    .modal-content {
        border-radius: 8px;
        border: 1px solid #007bff;
    }

    .modal-footer {
        border-top: 1px solid #e9ecef;
    }

    .modal-body {
        padding: 20px;
        background-color: #f8f9fa;
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

<a data-bs-toggle="modal" data-bs-target="#ModalAñadir" class="btn btn-add" role="button">Añadir <i class="fa-regular fa-square-plus"></i></a>
<hr>

<!-- Modal para Añadir -->
<div class="modal fade" id="ModalAñadir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Unidad de medida</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="message" class="alert alert-success" style="display: none;">Se añadió correctamente</div>
                <form action="{{ route('unidad.store') }}" method="POST" onsubmit="showLoader(); setTimeout(hideLoader, 7000); showMessage();">
                    @csrf
                    <div class="mb-3">
                        <label for="nombreUnidad" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreUnidad" name="Nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-12 justify-content-center">
    <h5 class="fw-bold">Listado de Unidades de Medida</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unidades as $unidad)
            <tr>
                <td>{{ $unidad->Nombre }}</td>
                <td>
                    <form action="{{ route('unidad.destroy', $unidad->id) }}" method="POST" style="display:inline;">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="btn btn-icon" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta unidad?');">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    <button type="button" class="btn btn-icon" data-bs-toggle="modal" data-bs-target="#ModalEditar{{ $unidad->id }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-icon" data-bs-toggle="modal" data-bs-target="#ModalMostrar{{ $unidad->id }}">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </td>
            </tr>

            <!-- Modal para Editar -->
            <div class="modal fade" id="ModalEditar{{ $unidad->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Unidad de Medida</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('unidad.update', $unidad->id) }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="mb-3">
                                    <label for="nombreUnidad" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombreUnidad" name="Nombre" value="{{ $unidad->Nombre }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Mostrar Detalles -->
            <div class="modal fade" id="ModalMostrar{{ $unidad->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de la Unidad</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label"><strong>Nombre:</strong></label>
                                <p>{{ $unidad->Nombre }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    <!-- Pantalla de Carga -->
    <div id="loader" class="overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script>
        function showLoader() {
            document.getElementById('loader').style.display = 'block';
        }

        function hideLoader() {
            document.getElementById('loader').style.display = 'none';
        }

        function showMessage() {
            document.getElementById('message').style.display = 'block';
        }
    </script>
</div>

<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
@endsection
