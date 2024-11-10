<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .logo { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table, .table th, .table td { border: 1px solid black; padding: 8px; text-align: left; }
        .header, .footer { text-align: center; }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        @if ($impresion && $impresion->logo)
            <img src="{{ public_path($impresion->logo) }}" alt="Logo" width="100">
        @else
            <p>Logo no disponible</p>
        @endif
    </div>

    <!-- Datos del Contribuyente -->
    <div class="header">
        <h3>Factura de Compra y Venta</h3>
        <p>NIT: {{ $facturaData['nit'] }}</p>
        <p>Nombre o Razón Social: {{ $facturaData['razon_social'] }}</p>
        <p>Dependencia: {{ $facturaData['dependencia'] ?? 'No asignada' }}</p>
    </div>

    <!-- Datos de la Transacción -->
    <table class="table">
        <thead>
            <tr>
                <th>Codigo/Descripción</th>
                <th>Cantidad</th>
                <th>Unidad de Medida</th>
                <th>Precio Unitario</th>
                <th>Descuento</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturaData['productos'] as $producto)
            <tr>
                <td>{{ $producto['descripcion'] }}</td>
                <td>{{ $producto['cantidad'] }}</td>
                <td>{{ $producto['unidad'] }}</td>
                <td>{{ number_format($producto['precio_unitario'], 2) }}</td>
                <td>{{ number_format($producto['descuento'], 2) }}</td>
                <td>{{ number_format($producto['subtotal'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="footer">
        <p>Total: {{ number_format($facturaData['total'], 2) }} Bs.</p>
    </div>
</body>
</html>
