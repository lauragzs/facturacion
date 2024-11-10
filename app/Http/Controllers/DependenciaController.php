<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dependencia;

class DependenciaController extends Controller
{
    //
    public function index()
    {
        //
        $dependencia=Dependencia::all();
        return view('Dependencia.dependencia',['dependencia'=>$dependencia]);
    }

    public function store(Request $request)
    {
        //
        $dependencia= new Dependencia($request->all());
        $dependencia->save();
        return redirect()->action([DependenciaController::class, 'index']);
    }
    public function update(Request $request, string $id)
    {
        //
        $dependencia=Dependencia::FindOrFail($id);
        $dependencia->nombre=$request->nombre;
        $dependencia->tipo=$request->tipo;
        $dependencia->region=$request->region;
        $dependencia->save();
        return back()->with("correcto", "Dependencia modificada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $dependencia=Dependencia::findOrFail($id);
        $dependencia->delete();
        return redirect()->action([DependenciaController::class,'index']);
    }
}
