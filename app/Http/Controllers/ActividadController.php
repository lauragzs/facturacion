<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\DB;


class ActividadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $actividades=Actividad::all();
        return view('ActividadEc.actividad', ['actividades'=>$actividades]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pdfs()
    {
        //
        return view('pdfs.actividad_pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        DB::beginTransaction();

        $indice = $request->input('indice');
        $codigo_producto_sin = $request->input('Codigo_Producto_SIN');
        $codigo_actividad_caeb = $request->input('Codigo_Actividad_CAEB');
        $descripcion_o_producto_sin = $request->input('Descripcion_o_producto_SIN');

        foreach ($indice as $i) {
            $actividad = new Actividad;
            $actividad->Codigo_Producto_SIN = $codigo_producto_sin[$i];
            $actividad->Codigo_Actividad_CAEB = $codigo_actividad_caeb[$i];
            $actividad->Descripcion_o_producto_SIN = $descripcion_o_producto_sin[$i];
            $actividad->save();
        }

        DB::commit();

        return redirect()->action([ActividadController::class, 'index']);
    } catch (\Exception $e) {
        DB::rollback();
        // Manejar el error
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $actividad=Actividad::findorFail($id);
        return view('actividad_ver',['actividad'=>$actividad]);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validar los datos
    $request->validate([
        'Codigo_Producto_SIN' => 'required|integer',
        'Codigo_Actividad_CAEB' => 'required|integer',
        'Descripcion_o_producto_SIN' => 'required|string|max:255',
    ]);

    // Encontrar la actividad por ID y actualizarla
    $actividad = Actividad::findOrFail($id);
    $actividad->update($request->all());

    // Redirigir o retornar respuesta
    return redirect()->route('actividad.index')->with('success', 'Actividad actualizada con éxito.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $actividad=Actividad::findOrFail($id);
        $actividad->delete();
        return redirect()->action([ActividadController::class,'index']);
    }
}
