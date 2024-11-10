<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos/Servicios</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/2713879efc.js" crossorigin="anonymous"></script>


    <style>
        header {
            background-color: #0461ae;
        }

        #sidebar,
        .list-group-item {
            background-color: #d3d6df;
        }

        .bi {
            color: #ffffff;
        }

        .list-group-item:hover {
            background-color: #c5cbe0;
            color: #02297e;
            text-decoration: underline
        }

        .sideic {
            color: #02297e;
        }

    </style>
</head>

<body>
    <header class="py-3">
        <div class="container-fluid d-flex">
            <div class="flex-shrink-1 col-md-3">
                <a href="#" class="d-block align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none">
                    <img src="https://fiva.impuestos.gob.bo/gpri/javax.faces.resource/images/LOGO-SIAT.png.xhtml?ln=common" alt="user" width="120">
                </a>
            </div>
            <div class="flex-shrink-1 col-md-1">
                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="rounded-3 p-1 text-decoration-none"><i class="bi bi-list bi-lg py-2 p-1"></i></a>
            </div>
            <div class="flex-shrink-1 offset-md-7 col-md-1 d-none d-sm-block d-xs-none">
                <a href="#" class="rounded-3 p-1 text-decoration-none"><i class="bi bi-bell"></i></a>
            </div>
            <div class="flex-shrink-1 col-md-1 d-none d-sm-block d-xs-none">
                <a href="#" class="rounded-3 p-1 text-decoration-none"><i class="bi bi-megaphone"></i></a>
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
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <a href="{{ route('home') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-house-door-fill"></i><span>   Menú Principal</span></a>
                        <a href="{{ route('dependencia') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-people-fill"></i><span>   Dependencia</span></a>
                        <a href="{{ route('tipodoc') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-people-fill"></i><span>   Tipo de documentos Personales</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-pencil-square"></i><span>   Solicitud</span></a>
                        <a href="{{ route('cliente') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-people-fill"></i><span>   Administración de Clientes</span></a>
                        <a href="#" data-bs-target="#collapseExample" data-bs-toggle="collapse" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-boxes"></i><span>   Administración de Productos</span> <i class="sideic bi bi-chevron-right"></i></a>
                        <div id="collapseExample" class="collapse">
                            <a href="{{ route('producto.index') }}" class="list-group-item"><i class="sideic bi bi-chevron-right"></i><i class="sideic bi bi-check2-square"></i><span>  Gestión de Productos</span></a>
                            <a href="#" class="list-group-item"><i class="sideic bi bi-chevron-right"></i><i class="sideic bi bi-check2-square"></i><span>  Gestión Masiva de Productos</span></a>
                        </div>
                        <a href="{{ route('factura.create') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-calculator-fill"></i><span>   Emisión</span> </a>
                        <a href="{{ route('impresion.create') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-gear-fill"></i><span>   Configuración</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-envelope-x-fill"></i><span>   Anulación</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-bar-chart-line-fill"></i><span>   Consultas Emisión</span></a>
                        <a href="{{ route('actividad.index') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-cash-coin"></i><span> Registrar Actividad Económica</span></a>
                        <a href="{{ route('unidad') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-rulers"></i><span> Registrar Unidad de Medida</span></a>
                        <a href="{{ route('sucursal') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-shop"></i><span> Registrar Sucursal</span></a>
                        <a href="{{ route('documentosf') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-file-earmark-lock"></i><span> Registrar Documento Fiscal</span></a>
                        <a href="{{ route('documentos') }}" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="sideic bi bi-window-dock"></i><span> Registrar Sectores de Documentos</span></a>
                    </div>
                </div>
            </div>
            <main class="col ps-md-2 pt-2">
                <div class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2>Facturación Porta Web en Línea - Gestión de Productos/Servicios</h2>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Listado de Productos/Servicios habilitados a su NIT</h3>
                                            <hr>
                                            <div><a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalCrear">Agregar <i class="bi bi-person-plus"></i></a></div>
                        <!-- Modal crear -->
                        <div class="modal fade" id="ModalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg"> <!-- Cambiado a modal-lg para hacerlo más grande -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agregar Documentos por sector</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario de creación de productos -->
                                        <form action="{{ route('producto.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="actividad-economica">Listado de Productos y Servicios Asignados por su(s) Actividad(es) Economica(s)</h4>
                                                    <table id="tabact" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Código Producto SIN</th>
                                                                <th>Código Actividad CAEB</th>
                                                                <th>Descripción Producto SIN</th>
                                                                <th>Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($actividad as $act)
                                                            <tr>
                                                                <td id="pid_actividad_{{ $act->id }}">{{ $act->id }}</td>
                                                                <td id="psin2_{{ $act->id }}">{{ $act->Codigo_Producto_SIN }}</td>
                                                                <td id="pcaeb2_{{ $act->id }}">{{ $act->Codigo_Actividad_CAEB }}</td>
                                                                <td id="pdescp2_{{ $act->id }}">{{ $act->Descripcion_o_producto_SIN }}</td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success bt_seleccionar" data-id="{{ $act->id }}">Seleccionar</button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <style>
                                                .form-outline {
                                                    display: flex;
                                                    align-items: center;
                                                }
                                                .form-outline label {
                                                    flex: 0 0 40%; /* Establece el ancho del label */
                                                    margin-bottom: 0; /* Elimina el margen inferior del label */
                                                }
                                                .form-outline input,
                                                .form-outline select {
                                                    flex: 1; /* Establece que el input y select ocupen todo el espacio restante */
                                                    margin-left: 10px; /* Ajusta el margen izquierdo */
                                                }
                                                .char-counter {
                                                    margin-top: 5px; /* Ajusta el margen superior del contador */
                                                    font-size: 12px; /* Tamaño de fuente del contador */
                                                    color: #6c757d; /* Color del contador */
                                                }
                                            </style>
                                            <div class="oculto" style="display: none;">
                                                <div class="row mb-3">
                                                    <div class="form-outline col-lg-12 col-md-12">
                                                        <label class="form-label"><strong>Código Producto SIN: </strong></label>
                                                        <label id="psin" name="sin"></label>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="form-outline col-lg-12 col-md-12">
                                                        <label class="form-label"><strong>Código Actividad CAEB: </strong></label>
                                                        <label id="pcaeb" name="caeb"></label>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="form-outline col-lg-12 col-md-12">
                                                        <label class="form-label"><strong>Descripción Producto SIN: </strong></label>
                                                        <label id="pdescp" name="descp"></label>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="form-outline col-lg-12 col-md-12">
                                                        <label class="form-label"><strong>Código Producto Contribuyente:</strong></label>
                                                        <input type="text" name="cod_pcontribuyente" class="form-control" placeholder="Digite codigo del producto"/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="form-outline col-lg-12 col-md-12">
                                                        <label class="form-label"><strong>Descripción Producto Contribuyente:</strong></label>
                                                        <textarea name="desc_pcontribuyente" id="coso" class="form-control" placeholder="Escriba la descripción del producto" style="width: 100%;"cols="20" rows="5"></textarea>
                                                    </div>
                                                    <div id="char-counter" class="char-counter" class="row mb-2" style="display: flex; justify-content: flex-end;">500 caracteres restantes</div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-outline col-lg-12 col-md-12">
                                                        <label class="form-label"><strong>Precio:</strong></label>
                                                        <input type="number" name="precio" class="form-control" placeholder="0.0000"/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                <div class="form-outline col-lg-12 col-md-12">
                                                        <label class="form-label"><strong>Unidad de Medida:</strong></label>
                                                        <select name="unidad_id" id="unidad_id" class="form-control">
                                                            @foreach ($unidad as $uni)
                                                            <option value="{{ $uni->id }}">{{ $uni->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="actividad_id" name="actividad_id">
                                                <br>
                                                <input class="btn btn-danger" type="submit" value="Añadir">
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal crear -->
                                        </div>
                                        <div class="card-body">
                                            <table id="tab" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Código Producto SIN</th>
                                                        <th>Código Actividad CAEB</th>
                                                        <th>Descripción Producto SIN</th>
                                                        <th>Código Producto Contribuyente</th>
                                                        <th>Descripción Producto Contribuyente</th>
                                                        <th>Precio</th>
                                                        <th>Unidad de Medida</th>
                                                        <th>‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎  </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($producto as $prod)
                                                    <tr>
                                                        <td>{{ $prod->id }}</td>
                                                        <td>{{ $prod->sin }}</td>
                                                        <td>{{ $prod->caeb }}</td>
                                                        <td>{{ $prod->descp }}</td>
                                                        <td>{{ $prod->cod_pcontribuyente }}</td>
                                                        <td>{{ $prod->desc_pcontribuyente }}</td>
                                                        <td>{{ $prod->precio }}</td>
                                                        <td>{{ $prod->unidad }}</td>
                                                        <td>
                                                        <form action="{{route('producto.destroy', $prod->id)}}" method="POST" style="display:inline;">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                        <button class="btn border-0" type="submit" value="Eliminar" onclick="return Eliminar Producto('Eliminar Producto')"><i class="fa-solid fa-trash"></i></a></button></form>
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square" ></i></a>
                                                        </td>
                                                        <!--Modal editar-->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <font align="center"><h1 class="modal-title fs-5" id="exampleModalLabel">Editar</h1></font>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form action="{{route('producto.update', $prod->id)}}" method="POST">
                                                            @csrf
                                                                {{method_field('PUT')}}
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Descripcion Producto Contribuyente</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="desc_pcontribuyente" value="{{$prod->desc_pcontribuyente}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                        </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@section('content')
    <hr>
    <table id="tab" class="table ">
        <tr>
            <th>N°</th>
            <th>Código Producto SIN</th>
            <th>Código Actividad CAEB</th>
            <th>Descripción Producto SIN</th>
            <th>Código Producto Contribuyente</th>
            <th>Descripción Producto Contribuyente</th>
            <th>Precio</th>
            <th>Unidad de Medida</th>
            <th>Operaciones </th>
        </tr>
        @foreach ($producto as $producto)
        <tr>
            <td>{{ $producto->id}}</td>
            <td>{{ $producto->sin}}</td>
            <td>{{ $producto->caeb}}</td>
            <td>{{ $producto->descp}}</td>
            <td>{{ $producto->cod_pcontribuyente}}</td>
            <td>{{ $producto->desc_pcontribuyente}}</td>
            <td>{{ $producto->precio}}</td>
            <td>{{ $producto->unidad}}</td>
            <td>
            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square" 
            
            ></i></a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
<img src="https://fiva.impuestos.gob.bo/gpri/javax.faces.resource/images/LOGO-SIAT.png.xhtml?ln=common" alt="user" width="32" height="32" class="rounded-circle">
    <footer>
        <!-- Coloca el pie de página aquí -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.bt_seleccionar').click(function(){
            var id = $(this).data('id');
            var codigoProductoSIN = $('#psin2_' + id).text().trim();
            var codigoActividadCAEB = $('#pcaeb2_' + id).text().trim();
            var descripcionProductoSIN = $('#pdescp2_' + id).text().trim();

            // Asignar valores a los elementos del formulario oculto
            $('#psin').text(codigoProductoSIN);
            $('#pcaeb').text(codigoActividadCAEB);
            $('#pdescp').text(descripcionProductoSIN);
            $('#actividad_id').val(id);

            // Asignar la descripción del producto al campo visible
            $('#desc_pcontribuyente').val(descripcionProductoSIN);

            // Ocultar la sección de actividad económica completa
            $('.card-body').hide();

            // Mostrar el formulario oculto
            $('.oculto').show();

            // Enfocar el primer campo del formulario oculto
            $('#desc_pcontribuyente').focus();
        });

        // Mostrar la sección de actividad económica y ocultar el formulario oculto al cerrar el modal
        $('#ModalCrear').on('hidden.bs.modal', function () {
            $('.card-body').show();
            $('.oculto').hide();
        });

       // Contador de caracteres para el textarea
       $('#coso').on('input', function() {
            var maxLength = 500;
            var currentLength = $(this).val().length;
            var remaining = maxLength - currentLength;
            if (remaining >= 0) {
                $('#char-counter').text(remaining + ' caracteres restantes');
            } else {
                $('#char-counter').text('0 caracteres restantes');
                var truncatedText = $(this).val().substring(0, maxLength);
                $(this).val(truncatedText);
            }
        });
    });
</script>
</body>
</html>