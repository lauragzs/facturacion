@extends('base')

@section('name')
    Listado de Dependencias
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

    .row {
        margin-bottom: 10px;
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

<!-- MODAL DE AÑADIR -->
<div class="modal fade" id="ModalAñadir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Dependencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="message" class="alert alert-success" style="display: none;">Se añadió correctamente</div>
                <form action="{{ route('dependencia.store') }}" method="POST" onsubmit="showLoader(); setTimeout(hideLoader, 7000); showMessage();">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Dependencia</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="region" class="form-label">Región</label>
                        <input type="text" class="form-control" id="region" name="region" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Añadir <i class="fa-solid fa-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-12 justify-content-center">
    <h5 class="fw-bold">Listado de Dependencias</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo de Dependencia</th>
                <th>Región</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dependencia as $dep)
            <tr>
                <td>{{ $dep->nombre }}</td>
                <td>{{ $dep->tipo }}</td>
                <td>{{ $dep->region }}</td>
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#ModalEditar{{ $dep->id }}" class="btn btn-icon"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a data-bs-toggle="modal" data-bs-target="#ModalVer{{ $dep->id }}" class="btn btn-icon"><i class="fa-solid fa-eye"></i></a>
                    <form action="{{ route('dependencia.destroy', $dep->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta dependencia?');">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="btn btn-icon" type="submit">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- MODAL DE EDITAR -->
            <div class="modal fade" id="ModalEditar{{ $dep->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Dependencia</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('dependencia.update', $dep->id) }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $dep->nombre }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo de Dependencia</label>
                                    <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $dep->tipo }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="region" class="form-label">Región</label>
                                    <input type="text" class="form-control" id="region" name="region" value="{{ $dep->region }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Cambios <i class="fa-solid fa-save"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL VER -->
            <div class="modal fade" id="ModalVer{{ $dep->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ver Dependencia</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nombre:</strong> {{ $dep->nombre }}</p>
                            <p><strong>Tipo de Dependencia:</strong> {{ $dep->tipo }}</p>
                            <p><strong>Región:</strong> {{ $dep->region }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar <i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    <!-- Carga -->
    <div id="loader" class="overlay" style="display: none;">
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
@endsection
