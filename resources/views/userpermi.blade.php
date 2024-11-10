@extends('base')
@section('name')
  Asignar Roles a usuarios
@endsection
@section('content')
  <table id="tab" class="table table-bordered table-striped">
    <thead>
      <tr>
          
          <table id="tab" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#ModalEditarRol{{ $user->id }}" class="btn btn-outline-success">Editar</a>
                </td>
              </tr>
              
              <!-- Modal para Editar Rol -->
              <div class="modal fade" id="ModalEditarRol{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Roles para {{ $user->name }}</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('asignar.update', $user->id) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        
                        <ul class="list-unstyled">
                          @foreach($role as $roles)
                            <li>
                              <input type="checkbox" name="roles[]" value="{{ $roles->id }}" id="role_{{ $roles->id }}">
                              <label for="role_{{ $roles->id }}">{{ $roles->name }}</label>
                            </li>
                          @endforeach  
                        </ul>
                        <button class="btn btn-outline-success" type="submit">Asignar Rol</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
        
              @endforeach
            </tbody>
          </table>        
      </tr>
    </tbody>
  </table>
@endsection
