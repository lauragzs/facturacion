@extends('base')
@section('name')
Ver Rol@endsection
@section('content')
  <div class="info-container">
    <label class="info-label">Nombre:</label>
    <span>{{ $rol->name }}</span><br>
    <label class="info-label">Guard Name:</label>
    <span>{{ $rol->guard_name }}</span><br>
      <a href="{{ route('rol') }}" class="btn btn-outline-primary">Volver a la lista de Roles</a>

  </div>
  @endsection