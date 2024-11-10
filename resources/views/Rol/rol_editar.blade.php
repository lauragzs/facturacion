@extends('base')
@section('name')
Editar Rol
@endsection
@section('content')
  <div class="form-container">
    <form action="{{ route('rol.update', $rol->id) }}" method="post">
      @csrf
      {{ method_field('PUT') }}
      
      <label>Nombre del rol:</label>
      <input type="text" name="name" value="{{ $rol->name }}" required>
      
      <label>Guard Name:</label>
      <input type="text" name="guard_name" value="{{ $rol->guard_name }}" required>
      
      <input type="submit" value="Actualizar">
    </form>
    <a href="{{ route('rol') }}" class="btn btn-outline-primary">Volver a la lista de Roles</a>

  </div>
@endsection