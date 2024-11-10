<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Factura;
use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Tipo_documento;
use App\Models\Detalle_factura;
use App\Models\User;
use App\Models\Unidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Asegúrate de importar la clase Str
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Impresion; // Asegúrate de importar el modelo

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado

        // Inicializar variables para la vista
        $razonSocial = '';
        $email = '';
        $nit = '';

        $producto=Producto::join('unidades', 'productos.unidad_id', '=', 'unidades.id')
                ->select('productos.*', 'unidades.nombre as unidad_nombre')
                ->get();
        $actividad = Actividad::all();
        $sucursal = Sucursal::all();
        $tipodoc = Tipo_documento::all();
        $user = User::all();
        $factura = DB::table('facturas')
        ->select('facturas.id','facturas.casos_esp','facturas.fecha','facturas.cod_auto',
        'sucursales.Nombre as sucursal','actividades.Descripcion_o_producto_SIN as actividad',
        'tipo_documentos.Nombre as tipodoc','users.razon_social as razons')
        ->leftJoin('sucursales', 'sucursales.id', '=', 'facturas.id_sucursal')
        ->leftJoin('actividades', 'actividades.id', '=', 'facturas.id_actividad')
        ->leftJoin('tipo_documentos', 'tipo_documentos.id', '=', 'facturas.id_tipodoc')
        ->leftJoin('users', 'users.id', '=', 'facturas.id_user')
        ->get();
        //dd($empleado);
        return view('Facturas.factura_tabla',[

            'usuario' => $usuario, // Pasar el usuario autenticado a la vista
            'razonSocial' => $razonSocial,
            'email' => $email,
            'nit' => $nit,
            'factura'=>$factura,
            'actividad' => $actividad,
            'sucursal' => $sucursal,
            'tipodoc' => $tipodoc,
            'user' => $user,
            'producto' => $producto,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto=Producto::join('unidades', 'productos.unidad_id', '=', 'unidades.id')
                ->select('productos.*', 'unidades.nombre as unidad_nombre')
                ->get();
        $actividad = Actividad::all();
        $sucursal = Sucursal::all();
        $tipodoc = Tipo_documento::all();
        $user = User::all();
        return view('Facturas.factura', [
            'actividad' => $actividad,
            'sucursal' => $sucursal,
            'tipodoc' => $tipodoc,
            'user' => $user,
            'producto' => $producto,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    DB::beginTransaction();
    
    $factura = new Factura;
    $factura->casos_esp = $request->get('casos_esp');
    $factura->fecha = $request->get('fecha');
    $factura->id_sucursal = $request->get('id_sucursal');
    $factura->id_actividad = $request->get('id_actividad');
    $factura->id_tipodoc = $request->get('id_tipodoc');
    $factura->id_user = $request->get('id_user');
    $factura->save();

    $id_producto = $request->get('id_producto');
    $cantidad = $request->get('cantidad');
    $descuento = $request->get('descuento');
    $desc_ad = $request->get('desc_ad');

    $productos = [];
    $total = 0;

    for ($i = 0; $i < count($id_producto); $i++) {
        $subtotal = ($cantidad[$i] * $id_producto[$i]) - $descuento[$i];
        $productos[] = [
            'descripcion' => Producto::find($id_producto[$i])->descripcion,
            'cantidad' => $cantidad[$i],
            'unidad' => Unidad::find(Producto::find($id_producto[$i])->unidad_id)->nombre,
            'precio_unitario' => Producto::find($id_producto[$i])->precio_unitario,
            'descuento' => $descuento[$i],
            'subtotal' => $subtotal,
        ];
        $total += $subtotal;
    }

    DB::commit();

    $facturaData = [
        'nit' => $factura->id_user ? User::find($factura->id_user)->nit : 'N/A',
        'razon_social' => $factura->id_user ? User::find($factura->id_user)->razon_social : 'N/A',
        'dependencia' => $factura->id_sucursal ? Sucursal::find($factura->id_sucursal)->nombre : 'No asignada',
        'productos' => $productos,
        'total' => $total,
    ];

    // Obtener el logo de la impresión
    $impresion = Impresion::findOrFail($factura->id_user); // O ajusta la consulta según sea necesario

    // Generar el PDF usando la vista
    $pdf = Pdf::loadView('Facturas.factura_pdf', compact('facturaData', 'impresion'));

    return response()->streamDownload(function () use ($pdf) {
        echo $pdf->output();
    }, 'factura.pdf', [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="factura.pdf"'
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        /*//
        $factura = Factura::findOrFail($id);
        return view('Empleados.empleado_ver', ['empleado'=>$empleado]);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $factura = Factura::findOrFail($id);
        $factura->delete();
        return redirect()->action([FacturaController::class, 'index']);
    }
}
