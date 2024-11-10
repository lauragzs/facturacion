<?php

namespace App\Http\Controllers;

use App\Models\Tipo_documento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $tipo_documento=Tipo_documento::all();
        return view('Tipo_documento.tipo_documento',['tipo_documento'=>$tipo_documento]);
    }

    public function store(Request $request)
    {
        //
        $tipo_documento= new Tipo_documento($request->all());
        $tipo_documento->save();
        return redirect()->action([TipoDocumentoController::class, 'index']);
    }
    public function update(Request $request, string $id)
    {
        //
        $tipo_documento=Tipo_documento::FindOrFail($id);
        $tipo_documento->Nombre=$request->Nombre;
        $tipo_documento->Codigo_doc=$request->Codigo_doc;
        $tipo_documento->save();
        return back()->with("correcto", "Tipo de documento modificado correctamente");
    }

    public function destroy(string $id)
    {
        //
        $tipo_documento=Tipo_documento::findOrFail($id);
        $tipo_documento->delete();
        return redirect()->action([TipoDocumentoController::class,'index']);
    }
}
