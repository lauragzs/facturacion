@extends('base')
@section('name')
  Nuevo Rol
@section('content')
  <div class="form-container">
    <form action="{{ route('rol.store') }}" method="POST">
      @csrf
      <div class="form-outline mb-4">
        <label class="form-label" for="formNombre">Nombre</label>
        <input type="text" name="name" class="form-control" placeholder="Ingresa el Nombre" required/>
      </div>
      <div class="form-outline mb-4">
        <label class="form-label" for="formDescripcion">Nombre 2</label>
        <input type="text" name="guard_name" class="form-control" placeholder="Ingresa el Nombre 2" required/>
      </div>
      <input type="submit" value="Crear">
    </form>
    <a href="{{ route('rol') }}" class="btn btn-outline-primary">Volver a la lista de Roles</a>

  </div>
@endsection