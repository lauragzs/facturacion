@extends('base')
@section('name')
  Listado de Documentos por Sector
@endsection
@section('content')
  <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalCrear">Agregar <i class="fa-solid fa-user-plus"></i></a>
  <hr>
  <!--Modal crear-->
  <div class="modal fade" id="ModalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <font align="center"><h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Documentos por sector</h1></font>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('documentos.store')}}" method="POST">
              @csrf
              <input type="hidden" name="_token" value="{{csrf_token()}}"> 
              <br>
          <div class="mb-3">
            <label class="form-label">Descripcion</label>
            <input type="text" class="form-control"  name="Descripcion"> 
          </div>
          <div class="mb-3">
            <label class="form-label">Caracteristicas</label>
            <input type="text" class="form-control"  name="Caracteristicas">
          </div>
          <div class="card">
            <div class="card-body">
                <div class="row">
                <div class="col-3 col-mb-3 col-sm-3">
                    <label>Tipo de documento/factura</label>
                    <select class="form-select" name="Tipo_documento" id="pid_articulo" aria-label="Default select example">
                    @foreach($DocumentosF as $doc)
                        <option value="{{$doc->id}}">{{$doc->Nombre}}</option>
                    @endforeach
                    </select>
                </div>
                <div>
                    <br>
                </div>
                </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary form-control">Añadir</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!---->
  <!--Modal crear-->
  <div class="modal fade" id="ModalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <font align="center"><h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Documentos por sector</h1></font>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('documentos.store')}}" method="POST">
              @csrf
              <input type="hidden" name="_token" value="{{csrf_token()}}"> 
              <br>
          <div class="mb-3">
            <label class="form-label">Descripcion</label>
            <input type="text" class="form-control"  name="Descripcion"> 
          </div>
          <div class="mb-3">
            <label class="form-label">Caracteristicas</label>
            <input type="text" class="form-control"  name="Caracteristicas">
          </div>
          <div class="card">
            <div class="card-body">
                <div class="row">
                <div class="col-3 col-mb-3 col-sm-3">
                    <label>Tipo de documento/factura</label>
                    <select class="form-select" name="Tipo_documento" id="pid_articulo" aria-label="Default select example">
                    @foreach($DocumentosF as $doc)
                        <option value="{{$doc->id}}">{{$doc->Nombre}}</option>
                    @endforeach
                    </select>
                </div>
                <div>
                    <br>
                </div>
                </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary form-control">Añadir</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!---->
  <div id="message" class="alert alert-success" style="display: none;">La accion se realizo correctamente</div>
  <!--Modal ver-->    
  <div class="modal fade" id="ModalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <font align="center"><h1 class="modal-title fs-5" id="exampleModalLabel">Ver</h1></font>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST">
        @csrf
          {{method_field('PUT')}}
    <div class="card">
      <div class="card-body">
          <div class="row">
          <div>
          <div class="col-12 col-md-12 justify-content-center">
          <table class="table table-striped table-bordered table-hover">
    <thead class="bg-primary text-white">
      <tr>
        <th>Descripcion</th>
        <th>Caracteristicas</th>
        <th>Tipo de factura/documento</th>
      </tr>
    </thead>
    <tbody>
      @foreach($documentoss as $documentoh)
      <tr>
        <td value="">{{$documentoh->Descripcion}}</td>
        <td value="">{{$documentoh->Caracteristicas}}</td>
        <td value="">{{$documentoh->DocumentosF->Nombre}}</td>
      <tr>
          @endforeach
  </tbody>
  </table>
          </div>
          </div>
      </div>
    </div>
    </div>
  </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!---->
<div class="col-12 col-md-12 justify-content-center">
  <table class="table table-striped table-bordered table-hover">
<thead class="bg-primary text-white">
<tr>
<th>Descripcion</th>
<th>Caracteristicas</th>
<th style="visibility:collapse; display:none;">Tipo de Factura/Documento</th>
<th>Operaciones</th>
</tr>
</thead>
<tbody>
@foreach($documentoss as $documentoh)
<tr>
<td>{{$documentoh->Descripcion}}</td>
<td>{{$documentoh->Caracteristicas}}</td>
<td style="visibility:collapse; display:none;">{{$documentoh->Tipo_documento}}</td>
<td>

<a role="" data-bs-toggle="modal" data-bs-target="#ModalVer"><i class="fa-solid fa-eye"></i></a>
</td>
</tr>
@endforeach
</tbody>
</table>
<!-- Agrega este HTML para la pantalla de carga -->
<div id="loader" class="overlay">
<div class="spinner-border text-primary" role="status">
<span class="visually-hidden">Loading...</span>
</div>
</div>

<!-- Agrega este CSS para estilizar la pantalla de carga -->
<style>
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