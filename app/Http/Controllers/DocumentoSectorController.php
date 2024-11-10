<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentosF;
use App\Models\DocumentoSector;
use Illuminate\Support\Facades\DB;

class DocumentoSectorController extends Controller
{
    //
    public function index()
    {
        //
        $DocumentosF=DocumentosF::all();
        $documentoss=DocumentoSector::with('DocumentosF')->get();
        return view('documento_sector', ['documentoss'=>$documentoss, 'DocumentosF'=>$DocumentosF]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $documentosf=DocumentosF::all();
        return view('doc_s_crear',['documentosf'=>$documentosf]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $documentos= new DocumentoSector($request->all());
        $documentos->save();

        return redirect()->action([DocumentoSectorController::class, 'index']);

    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $documentos=DocumentoSector::FindOrFail($id);
        $documentos->Descripcion=$request->Descripcion;
        $documentos->Caracteristicas=$request->Caracteristicas;
        $documentos->save();
        return redirect()->action([DocumentoSectorController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $documentos=DocumentoSector::findOrFail($id);
        $documentos->delete();
        return redirect()->action([DocumentoSectorController::class,'index']);
    }
}
