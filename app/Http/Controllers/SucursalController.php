<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class SucursalController extends Controller
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
        $sucursales=Sucursal::all();
        return view ('Sucursal.sucursal', ['sucursales'=>$sucursales]);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $sucursal=new Sucursal;
        $sucursal->Nombre=$request->get('Nombre');
        $sucursal->Ubicacion=$request->get('Ubicacion');
        $sucursal->save();
        return redirect()->action([SucursalController::class,'index']);
    }

    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $sucursal=Sucursal::FindOrFail($id);
        $sucursal->Nombre=$request->Nombre;
        $sucursal->Ubicacion=$request->Nombre;
        $sucursal->save();
        return back()->with("correcto", "Producto modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $sucursal=Sucursal::findOrFail($id);
        $sucursal->delete();
        return redirect()->action([SucursalController::class,'index']);
    }
}

