@extends('base')

@section('name')
    Listado de Documentos por Sector
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
<hr>

<!-- MODAL DE CREAR -->
<div class="modal fade" id="ModalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Documento por Sector</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="message" class="alert alert-success" style="display: none;">Se añadió correctamente</div>
                <form action="{{ route('documentos.store') }}" method="POST" onsubmit="showLoader(); setTimeout(hideLoader, 7000); showMessage();">
                    @csrf
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="Descripcion" required>
                    </div>
                    <div class="mb-3">
                        <label for="caracteristicas" class="form-label">Características</label>
                        <input type="text" class="form-control" id="caracteristicas" name="Caracteristicas" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_documento" class="form-label">Tipo de Documento/Factura</label>
                        <select class="form-select" name="Tipo_documento" required>
                            @foreach($DocumentosF as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Añadir <i class="fa-solid fa-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-12 justify-content-center">
    <h5 class="fw-bold">Listado de Documentos por Sector</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Características</th>
                <th>Tipo de Documento</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documentoss as $documentoh)
            <tr>
                <td>{{ $documentoh->Descripcion }}</td>
                <td>{{ $documentoh->Caracteristicas }}</td>
                <td>{{ $documentoh->DocumentosF->Nombre }}</td>
                <td>
                    <a href="" data-bs-toggle="modal" data-bs-target="#ModalEditar{{ $documentoh->id }}" class="btn btn-icon"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a data-bs-toggle="modal" data-bs-target="#ModalVer{{ $documentoh->id }}" class="btn btn-icon"><i class="fa-solid fa-eye"></i></a>
                    <form action="{{ route('documentos.destroy', $documentoh->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este documento?');">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="btn btn-icon" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este documento?');">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL DE EDITAR -->
    @foreach($documentoss as $documentoh)
    <div class="modal fade" id="ModalEditar{{ $documentoh->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Documento por Sector</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('documentos.update', $documentoh->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="Descripcion" value="{{ $documentoh->Descripcion }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="caracteristicas" class="form-label">Características</label>
                            <input type="text" class="form-control" id="caracteristicas" name="Caracteristicas" value="{{ $documentoh->Caracteristicas }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_documento" class="form-label">Tipo de Documento/Factura</label>
                            <select class="form-select" name="Tipo_documento" required>
                                @foreach($DocumentosF as $doc)
                                    <option value="{{ $doc->id }}" {{ $documentoh->Tipo_documento == $doc->id ? 'selected' : '' }}>{{ $doc->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios <i class="fa-solid fa-save"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- MODAL VER -->
    @foreach($documentoss as $documentoh)
    <div class="modal fade" id="ModalVer{{ $documentoh->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver Documento por Sector</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Descripción:</strong> {{ $documentoh->Descripcion }}</p>
                    <p><strong>Características:</strong> {{ $documentoh->Caracteristicas }}</p>
                    <p><strong>Tipo de Documento:</strong> {{ $documentoh->DocumentosF->Nombre }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar <i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Carga -->
    <div id="loader" class="overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script>
        function showLoader() {
            document.getElementById('loader').style.display = 'block';
            setTimeout(showMessage, 2000);
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
