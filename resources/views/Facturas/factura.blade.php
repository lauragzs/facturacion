@extends('base')
@section('name')
    Facturas de compra y venta
@endsection
@section('content')
<form action="{{ route('factura.store') }}" method="POST">
    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}" role="form">
    <div class="mb-3">
    <h3 class="fw-bold">Datos basicos del contribuyente</h3>
        @if(Auth::check())
        <div class="row datos-contribuyente mb-2">
            <div class="col-md-4">
                <label class="form-label">NIT:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->nit }}" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nombre o Razón Social:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->razon_social }}" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Dependencia:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->dependencia->nombre ?? 'No asignada' }}" readonly>
            </div>
        </div>
        @else
        <div class="alert alert-warning">
            No hay un usuario autenticado.
        </div>
        @endif
    </div>
    <h3 class="fw-bold">Datos de la Transacción Comercial</h3>


<div class="row align-items-center">
    <div class="col-md-3">
        <label for="id_sucursal">Dato de la Sucursal:</label>
    </div>
    <div class="col-md-6">
        <select class="form-select" name="id_sucursal" id="id_sucursal">
            @foreach ($sucursal as $sucursal)
                <option value="{{ $sucursal->id }}">{{ $sucursal->Nombre }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-md-3">
        <label for="id_actividad">Actividad:</label>
    </div>
    <div class="col-md-6">
        <select class="form-select" name="id_actividad" id="id_actividad">
            @foreach ($actividad as $actividad)
                <option value="{{ $actividad->id }}">{{ $actividad->Descripcion_o_producto_SIN }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-md-3">
        <label>Tipo excepción:</label>
    </div>
    <div class="col-md-6">
        <div>
            <input type="radio" id="ninguno" name="casos_esp" value="ninguno" checked>
            <label for="ninguno">Ninguna</label> 
            <input type="radio" id="99001" name="casos_esp" value="99001">
            <label for="99001">99001 (Extranjero no inscrito)</label>
            <input type="radio" id="99002" name="casos_esp" value="99002">
            <label for="99002">99002 (Control Tributario)</label>
            <input type="radio" id="99003" name="casos_esp" value="99003">
            <label for="99003">99003 (Ventas Menores)</label>
        </div>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-md-3">
        <label for="id_tipodoc">Tipo Documento:</label>
    </div>
    <div class="col-md-3">
        <select class="form-select" name="id_tipodoc" id="id_tipodoc">
            @foreach ($tipodoc as $tipodoc)
                <option value="{{ $tipodoc->id }}">{{ $tipodoc->Nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="documento_nit">N° Documento/NIT:</label>
    </div>
    <div class="col-md-3">
    <select class="form-select" name="id_user" id="id_user">
    @foreach ($user as $user)
            <option value="{{ $user->id }}">{{ $user->nit }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-md-3">
        <label for="codigo_complemento">Cód. Complemento:</label>
    </div>
    <div class="col-md-3">
        <input type="text" name="codigo_complemento" class="form-control" placeholder="Código Complemento" id="codigo_complemento">
    </div>
</div>
    <div class="row align-items-center">
    <div class="col-md-3">
        <label for="fecha">Fecha:</label>
    </div>
    <div class="col-md-3">
                <input type="date" name="fecha" class="form-control">
            </div>

    <div class="col-md-3">
        <label for="correo">Correo Electrónico:</label>
    </div>
    <div class="col-md-3">
        <input type="email" name="correo" class="form-control" placeholder="Ingrese su correo" id="correo">
    </div>
</div>


<div class="row">
    <div class="col-12 text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> <!-- Icono de lupa -->
            Buscar Cliente
        </button>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .divider-blue {
        border: none;
        height: 2px;
        background-color: #007bff;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .form-select, .form-control {
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .btn-primary i {
        margin-right: 5px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
    }

    .row {
        margin-bottom: 15px;
    }

    label {
        margin-bottom: 0;
        font-weight: bold;
    }
        h3.fw-bold {
        margin-bottom: 20px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }
    
</style>






    

<h3 class="fw-bold">Detalle de la Transacción Comercial</h3>
<hr>

<div class="row align-items-center">
    <!-- Código/Descripción y Precio Unitario -->
    <div class="col-md-3">
        <label for="pid_producto">Código/Descripción:</label>
    </div>
    <div class="col-md-3">
        <select class="form-select" name="id_producto[]" id="pid_producto">
            @foreach ($producto as $producto)
                <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" data-unidad_id="{{ $producto->unidad_nombre }}">
                    {{ $producto->cod_pcontribuyente }} - {{ $producto->desc_pcontribuyente }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Precio Unitario -->
    <div class="col-md-3">
        <label for="ppreciou">Precio Unitario:</label><br>
        <label id="ppreciou"></label>
    </div>
</div>

<div class="row align-items-center">
    <!-- Cantidad y Unidad de Medida -->
     
    <div class="col-md-3">
        <label for="pcantidad">Cantidad:</label>
    </div>
    <div class="col-md-3">
        <input type="number" id="pcantidad" name="cantidad[]"class="form-control" placeholder="0.0000"/>
    </div>

    <div class="col-md-3">
        <label for="punidad">Unidad Medida:</label><br>
        <label id="punidad"></label>
    </div>
    
</div>

<div class="row align-items-center">
    <!-- Descripción Adicional -->
    <div class="col-md-3">
        <label for="pdesc_ad">Descripción Adicional:</label>
    </div>
    <div class="col-md-6">
        <input type="text" id="pdesc_ad" name="desc_ad[]"class="form-control" placeholder="" >
    </div>
</div>

<div class="row align-items-center">
    <!-- Descuento -->
    <div class="col-md-3">
        <label for="pdescuento">Descuento (Bs):</label>
    </div>
    <div class="col-md-6">
        <input type="number" id="pdescuento" name="descuento[] "class="form-control" placeholder="0.0000"/>
    </div>
</div>

<div class="row justify-content-end">
<div class="col-md-3 text-end">
        <button type="button" class="btn btn-success btn-sm" id="bt_agregar">
            <i class="fas fa-shopping-cart"></i> Agregar
        </button>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .form-select, .form-control {
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .btn-success {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
    }

    .row {
        margin-bottom: 15px;
    }

    label {
        margin-bottom: 0;
        font-weight: bold;
    }

    h3.fw-bold {
        margin-bottom: 20px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }
</style>
</div>
    <div class="row">
        <table class="table">
            <thead class="thead-success">
                <tr>
                    <th>Operaciones</th>
                    <th>Codigo/Descripción</th>
                    <th>Cantidad</th>
                    <th>Unidad de Medida</th>
                    <th>Precio Unitario</th>
                    <th>Descuento por Producto</th>
                    <th>Subtotal por Producto</th>
                </tr>
            </thead>
            <tbody id="tablita">
                <!-- Contenido dinámico -->
            </tbody>
        </table>
        <hr>
    </div>
    <div class="row justify-content-end">
        <div class="col-auto">
            <input class="btn btn-success form-control" type="submit" value="Añadir">
        </div>
    </div>
</form>
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfPreviewModalLabel">Previsualización de Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfPreviewFrame" width="100%" height="500px"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="confirmSave">Confirmar y Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Evento al enviar el formulario
    $('form').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío normal

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Mostrar el PDF en el modal
                $('#pdfPreviewFrame').attr('src', 'data:application/pdf;base64,' + response.pdf);
                $('#pdfPreviewModal').modal('show');
            }
        });
    });

    // Confirmar y guardar después de la previsualización
    $('#confirmSave').on('click', function() {
        $('#pdfPreviewModal').modal('hide');
        // Aquí puedes hacer otra petición para guardar definitivamente, si es necesario
    });
});
</script>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function(){
        // Actualizar el label cuando se selecciona un producto
        $('#pid_producto').change(function() {
            var unida = $("#pid_producto option:selected").data('unidad_id');
            $('#punidad').text(unida);
            var prec = $("#pid_producto option:selected").data('precio');
            $('#ppreciou').text(prec);
        });
        $('#bt_agregar').click(function(){
            agregar();
        });
    });
    var cont=0;
    function agregar(){
    var id_producto = $("#pid_producto").val();
    var cantidad=$("#pcantidad").val();
    var descuento= $('#pdescuento').val();
    var desc_ad= $('#pdesc_ad').val();

    var preciou = $("#pid_producto option:selected").data('precio');
    var unidadm = $("#pid_producto option:selected").data('unidad_id');

    /*alert(preciou);
    alert(unidadm);*/
    var nombre=$("#pid_producto option:selected").text();
    //alert(nombre);
    if(cantidad!="" && cantidad>0 && descuento!="" && descuento>0 && desc_ad!=""){
        var fila = `
            <tr class="selected" id="fila${cont}">
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminar(${cont})">Eliminar</button>
                    </td>
                <td>
                    <input type="hidden" name="desc_ad[]" value="${desc_ad}">
                    <input type="hidden" name="id_producto[]" value="${id_producto}">
                    ${nombre}
                </td>
                <td>
                    <input type="number" name="cantidad[]" value="${cantidad}">
                </td>
                <td>
                    ${unidadm}
                </td>
                <td>
                    ${preciou}
                </td>
                <td>
                    <input type="number" name="descuento[]" value="${descuento}">
                </td>
                <td>
                    ${((preciou * cantidad) - descuento).toFixed(2)}
                </td>
            </tr>`;        
            cont++;
        $("#tablita").append(fila);
    } else{
        alert("Por favor rellenar los campos faltantes")
    }
}
    function eliminar(pos){
        $("#fila"+pos).remove();
    }
</script>
@endsection