@extends('base')

@section('name')
    Listado de Clientes
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
    }

   
    h5.fw-bold {
        margin-bottom: 20px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }

 
    .row {
        margin-bottom: 10px;
    }


    .btn-buscar {
        height: 40px;
        width: 100%; 
        background-color: #007bff; 
        color: white;
        border-radius: 3px;
        border: none;
        font-size: 16px;
    }

    .btn-limpiar {
        height: 40px;
        width: 100%; 
        background-color: #ff8c00; 
        color: white;
        border-radius: 3px;
        border: none;
        font-size: 16px;
    }

    .btn-guardar {
        height: 40px;
        width: 100%; 
        background-color: #28a745; 
        color: white;
        border-radius: 3px;
        border: none;
        font-size: 16px;
    }


    .btn-container {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

</style>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('cliente.buscarPorNit') }}" method="GET">
 
    <div class="mb-3">
        <h5 class="fw-bold">Datos Básicos del Contribuyente</h5>

        @if(isset($usuario))
            <div class="row datos-contribuyente mb-2">
                <div class="col-4">
                    <label class="form-label">NIT:</label>
                    <input type="text" class="form-control" value="{{ $usuario->nit }}" readonly>
                </div>
                <div class="col-4">
                    <label class="form-label">Nombre o Razón Social:</label>
                    <input type="text" class="form-control" value="{{ $usuario->razon_social }}" readonly>
                </div>
                <div class="col-4">
                    <label class="form-label">Dependencia:</label>
                    <input type="text" class="form-control" value="{{ $usuario->dependencia->nombre ?? 'No asignada' }}" readonly>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                No hay un usuario autenticado.
            </div>
        @endif
    </div>


    <h5 class="fw-bold">Búsqueda de Clientes</h5>
    <div class="row mb-3">
        <div class="col-3">
            <label for="tipodoc" class="form-label">Tipo</label>
            <select class="form-select" name="tipodoc_id" id="tipodoc">
                @foreach($tipodoc as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->Nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <label for="documento" class="form-label">Documento/NIT</label>
            <input type="text" class="form-control" placeholder="NIT" name="nit" value="{{ request('nit') }}" id="documento">
        </div>
        <div class="col-2">
            <label for="complemento" class="form-label">Cód. Complemento</label>
            <input type="text" class="form-control" name="complemento" id="complemento">
        </div>
        <div class="col-2">

    <button class="btn btn-buscar" type="submit">
        <i class="fas fa-search"></i> Buscar
    </button>
</div>

</form>


<form action="{{ route('cliente.store') }}" method="POST">
    @csrf
    <div class="row mb-3">
        <div class="col-6">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" name="razon_social" class="form-control" placeholder="Razón Social" value="{{ old('razon_social') }}" required>
        </div>
        <div class="col-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="celular" class="form-label">Celular</label>
            <input type="text" name="celular" class="form-control" placeholder="Celular" value="{{ old('celular') }}" required>
        </div>
        <div class="col-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ old('telefono') }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="nit" class="form-label">NIT</label>
            <input type="text" name="nit" class="form-control" placeholder="NIT" value="{{ old('nit') }}" required>
        </div>
        <div class="col-6">
            <label for="tipodoc_id" class="form-label">Tipo Documento</label>
            <select class="form-select" name="tipodoc_id" id="tipodoc_id" required>
                @foreach($tipodoc as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->Nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

  
    <div class="row mb-3">
    <div class="col-2 offset-10">
        <button class="btn btn-guardar" type="submit">
            <i class="fas fa-check"></i> Guardar
        </button>
    </div>
</div>
</form>

<hr>

@if(isset($clientes) && !$clientes->isEmpty())
    <table id="tab" class="table">
        <thead>
            <tr>
                <th>Tipo Documento</th>
                <th>N° Documento/NIT</th>
                <th>Complemento</th>
                <th>Razón Social</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->tipodoc }}</td>
                <td>{{ $cliente->nit }}</td>
                <td>{{ $cliente->complemento }}</td>
                <td>{{ $cliente->razon_social }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->celular }}</td>
                <td>{{ $cliente->telefono }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
