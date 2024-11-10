@extends('base')
@section('name')
  Editar Rol
@endsection
@section('content')
    <form action="{{ route('asignar.update', $user->id) }}" method="post">
      <ul>
        @csrf
        {{ method_field('PUT') }}
        
            @foreach($role as $roles)
                <li>
                <input type="checkbox" name="roles[]" value="{{ $roles->id }}" id="role_{{ $roles->id }}">
                <label for="role_{{ $roles->id }}">{{ $roles->name }}</label>
                </li>
                @endforeach  
      </ul>
      <button class="btn btn-outline-success" type="submit">Asignar Rol</button>
      
    </form>
@endsection