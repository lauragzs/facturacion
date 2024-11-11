<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Unidad;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB; // Agregar esta línea para usar DB

class HomeController extends Controller
{
    public function index()
    {
        // Cantidad de productos por unidad
        $productosPorUnidad = Producto::select('unidad_id', DB::raw('count(*) as total'))
            ->groupBy('unidad_id')
            ->with('unidad')
            ->get()
            ->map(function ($item) {
                return [
                    'unidad' => $item->unidad ? $item->unidad->Nombre : 'Sin Unidad',
                    'total' => $item->total,
                ];
            });

        // Precio promedio por unidad
        $precioPromedioPorUnidad = Producto::select('unidad_id', DB::raw('AVG(precio) as promedio'))
            ->groupBy('unidad_id')
            ->with('unidad')
            ->get()
            ->map(function ($item) {
                return [
                    'unidad' => $item->unidad ? $item->unidad->Nombre : 'Sin Unidad',
                    'promedio' => round($item->promedio, 2),
                ];
            });

       

        return view('home', compact('productosPorUnidad', 'precioPromedioPorUnidad'));
    }
}
