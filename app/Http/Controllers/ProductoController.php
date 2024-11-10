<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Actividad;
use App\Models\Unidad;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unidad = Unidad::all();
        $actividad = Actividad::all();

        // Aplicar búsqueda por descripción de Producto SIN si existe
        $query = Actividad::query();
        if ($request->has('descripcion')) {
            $query->where('Descripcion_o_producto_SIN', 'like', '%' . $request->descripcion . '%');
        }
        $actividad = $query->paginate(7); // Paginar por 7 elementos por página

        $producto = DB::table('productos')
            ->select('productos.id', 'productos.cod_pcontribuyente', 'productos.desc_pcontribuyente',
                'productos.precio', 'unidades.Nombre as unidad', 
                'actividades.Codigo_Producto_SIN as sin',
                'actividades.Codigo_Actividad_CAEB as caeb', 
                'actividades.Descripcion_o_producto_SIN as descp')
            ->leftJoin('unidades', 'unidades.id', '=', 'productos.unidad_id')
            ->leftJoin('actividades', 'actividades.id', '=', 'productos.actividad_id')
            ->get();

        return view('Producto.producto', [
            'producto' => $producto,
            'unidad' => $unidad,
            'actividad' => $actividad,
        ]);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos (puedes ajustar las reglas según sea necesario)
        $request->validate([
            'cod_pcontribuyente' => 'required|string',
            'desc_pcontribuyente' => 'required|string',
            'precio' => 'required|numeric',
            'unidad_id' => 'required|exists:unidades,id',
            'actividad_id' => 'required|exists:actividades,id',
        ]);

        // Crear un nuevo producto con los datos del request
        $producto = new Producto($request->all());
        $producto->save(); // Guardar el producto en la base de datos

        // Volver a cargar los datos para mostrar la vista actualizada
        $unidad = Unidad::all();
        $actividad = Actividad::all(); // Obtener todas las actividades

        // Obtener los productos con sus relaciones
        $productos = DB::table('productos')
            ->select('productos.id', 'productos.cod_pcontribuyente', 'productos.desc_pcontribuyente',
                'productos.precio', 'unidades.Nombre as unidad', 
                'actividades.Codigo_Producto_SIN as sin',
                'actividades.Codigo_Actividad_CAEB as caeb', 
                'actividades.Descripcion_o_producto_SIN as descp')
            ->leftJoin('unidades', 'unidades.id', '=', 'productos.unidad_id')
            ->leftJoin('actividades', 'actividades.id', '=', 'productos.actividad_id')
            ->get();

        // Redireccionar a la vista de productos con los datos actualizados
        return redirect()->route('producto.index')
            ->with('success', 'Producto guardado correctamente');
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        // Obtener todas las unidades y actividades para el formulario de creación
        $unidad = Unidad::all();
        $actividad = Actividad::all();
        return view('Producto.producto_crear', ['unidad' => $unidad, 'actividad' => $actividad]);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        // Encontrar un producto por su ID
        $producto = Producto::findOrFail($id);
        return view('Producto.producto_ver', ['producto' => $producto]);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar un producto por su ID
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('producto.index');
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos recibidos (puedes ajustar las reglas según sea necesario)
        $request->validate([
            'desc_pcontribuyente' => 'required|string',
        ]);

        // Actualizar el producto con la nueva información
        $producto = Producto::findOrFail($id);
        $producto->desc_pcontribuyente = $request->desc_pcontribuyente;
        $producto->save(); // Guardar los cambios

        return back()->with("correcto", "Producto modificado correctamente");
    }
}

