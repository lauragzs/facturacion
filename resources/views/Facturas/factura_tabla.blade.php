@extends('base')
@section('name')
    Reporte de Facturas de compra y venta
@endsection
@section('content')
<table id="tab" class="table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Casos Especiales</th>
            <th>Fecha</th>
            <th>Sucursal</th>
            <th>Actividad Económica</th>
            <th>Tipo de Documento</th>
            <th>Nombre Razón Social</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($factura as $factura)
        <tr>
            <td>{{ $factura->id }}</td>
            <td>{{ $factura->casos_esp }}</td>
            <td>{{ $factura->fecha }}</td>
            <td>{{ $factura->sucursal }}</td>
            <td>{{ $factura->actividad }}</td>
            <td>{{ $factura->tipodoc }}</td>
            <td>{{ $factura->razons }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection