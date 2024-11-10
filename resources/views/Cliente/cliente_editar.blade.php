<!doctype html>
<html lang="en">
<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
header{
    background-color: #0461ae;
}
#sidebar, .list-group-item{
    background-color: #d3d6df;

}
.bi{
    color:#ffffff;

}
.list-group-item:hover{
    background-color:#c5cbe0;
    color:#02297e;
    text-decoration:underline
}

.sideic{
    color:#02297e;

}

    </style>
</head>

<body>
    <header class="py-3 ">
        <div class="container-fluid  d-flex">
            <div class="flex-shrink-1 col-md-3">
                <a href="#" class="d-block align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none">
                    <img src="https://fiva.impuestos.gob.bo/gpri/javax.faces.resource/images/LOGO-SIAT.png.xhtml?ln=common" alt="user" >
                </a>
            </div>
            <div class="flex-shrink-1 col-md-1">
                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class=" rounded-3 p-1 text-decoration-none"><i class="bi bi-list bi-lg py-2 p-1"></i></a>
            </div>
            <div class="flex-shrink-1 offset-md-7 col-md-1 d-none d-sm-block d-xs-none">
                <a href="#"  class=" rounded-3 p-1 text-decoration-none"><i class="bi bi-bell"></i></a>
            </div>
            <div class="flex-shrink-1 col-md-1 d-none d-sm-block d-xs-none">
                <a href="#"  class=" rounded-3 p-1 text-decoration-none"><i class="bi bi-megaphone"></i></a>
            </div>
            <div class="flex-grow-1 d-flex align-items-right col-md-2 d-none d-sm-block d-xs-none">
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://via.placeholder.com/28?text=!" alt="user" width="32" height="32" class="rounded-circle"> Usuario
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

<div class="container-fluid">

    
    <div class="row flex-nowrap">
        <div class="col-auto px-0">
            <div id="sidebar" class="collapse collapse-horizontal show border-end">
                <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                    <a href="{{ route('home') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-house-door-fill"></i><span>   Menú Principal</span> </a>
                    <a href="{{ route('dependencia') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-people-fill"></i><span>   Dependencia</span> </a>
                    
                    <a href="{{ route('tipodoc') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-people-fill"></i><span>   Tipo de documentos Personales</span> </a>
                    <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-pencil-square"></i><span>   Solicitud</span> </a>
                    <a href="{{ route('cliente') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-people-fill"></i><span>   Administración de Clientes</span> </a>
                     <a href="#" data-bs-target="#collapseExample" data-bs-toggle="collapse" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-boxes"></i><span>   Administración de Productos</span> <i class="sideic bi bi-chevron-right"></i></a>
                        <div id="collapseExample" class="collapse">
                        <a href="{{ route('producto') }}" class="  list-group-item " ><i class="sideic bi bi-chevron-right"></i><i class="sideic bi bi-check2-square"></i><span>  Gestión de Productos</span> </a>
                        <a href="#" class="  list-group-item " ><i class="sideic bi bi-chevron-right"></i><i class="sideic bi bi-check2-square"></i><span>  Gestión Masiva de Productos</span> </a>
                        </div>
                    <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-calculator-fill"></i><span>   Emisión</span> </a>
                    <a href="{{ route('impresion.create') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-gear-fill"></i><span>   Configuración</span> </a>
                    <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-envelope-x-fill"></i><span>   Anulación</span> </a>
                    <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-bar-chart-line-fill"></i><span>   Consultas Emisión</span> </a>
                    <a href="{{route('actividad')}}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-cash-coin"></i><span> Registrar Actividad Economica </span> </a>
                    <a href="{{route('unidad')}}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-rulers"></i><span> Registrar Unidad de Medida</span> </a>
                    <a href="{{route('sucursal')}}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-shop"></i><span> Registrar Sucursal</span> </a>
                    <a href="{{route('documentosf')}}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-file-earmark-lock"></i><span> Registrar Documento Fiscal</span> </a>
                    <a href="{{route('documentos')}}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-window-dock"></i><span> Registrar Sectores de Documentos</span> </a>
                </div>
            </div>
        </div>
        <main class="col ps-md-2 pt-2">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                <hr>
                                <h1>Modificar cliente</h1>
                                <hr>
                                <a href="{{ route('cliente') }}" class="btn btn-primary" role="button">Ver lista de Clientes</a>
                                <hr>
                            </div>
                            <div class="col-12 col-md-12 justify-content-center">
                                <form action="{{ route('cliente.update',$cliente->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                                    <br>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Tipo Doc.:</label>
                                        <select name="tipodoc_id" id="tipodoc_id">
                                            @foreach ($tipodoc as $tipodoc)
                                              <option value="{{$tipodoc->id}}"> {{$tipodoc->Nombre}}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">N° Documento/NIT:</label>
                                        <input type="number" name="nit" class="form-control" value="{{ $cliente->nit }}"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Complemento:</label>
                                        <input type="text" name="complemento" class="form-control" value="{{ $cliente->complemento }}"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Razon Social:</label>
                                        <input type="text" name="razon_social" class="form-control" value="{{ $cliente->razon_social }}"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Email:</label>
                                        <input type="text" name="email" class="form-control" value="{{ $cliente->email }}"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Celular:</label>
                                        <input type="text" name="celular" class="form-control" value="{{ $cliente->celular }}"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Telefono:</label>
                                        <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}"/>
                                    </div>
                                      
                                    <input type="submit" value="ACTUALIZAR">
                                <form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<img src="https://fiva.impuestos.gob.bo/gpri/javax.faces.resource/images/LOGO-SIAT.png.xhtml?ln=common" alt="user" width="32" height="32" class="rounded-circle">
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>