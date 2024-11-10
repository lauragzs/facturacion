<?php

namespace App\Http\Controllers;

use App\Models\Impresion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImpresionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $impresion = Impresion::all();
        return view('Impresion.impresion', ['impresion' => $impresion]);
    }

    public function create()
    {
        return view('Impresion.impresion_crear');
    }

    public function store(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Asegúrate de ajustar las restricciones según sea necesario
            'tipoimp' => 'required|string'
        ]);

        $impresion = new Impresion($request->except('logo'));

        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $path = 'assets/img/';
            $filename = date('YmdHis') . "." . $logoFile->getClientOriginalExtension();
            $logoFile->move(public_path($path), $filename);

            $impresion->logo = $path . $filename;
        } else {
            $impresion->logo = 'assets/img/predeterminado.png'; // Ruta de la imagen predeterminada
        }

        $impresion->save();
        return redirect()->action([ImpresionController::class, 'index']);
    }

    public function show(string $id)
    {
        $impresion = Impresion::findOrFail($id);
        return view('Impresion.impresion_ver', ['impresion' => $impresion]);
    }
    public function destroy($id)
{
    $impresion = Impresion::find($id);
    
    if ($impresion) {
        // Eliminar el archivo de logo del almacenamiento si existe
        if (Storage::exists($impresion->logo)) {
            Storage::delete($impresion->logo);
        }
        
        // Eliminar el registro de la base de datos
        $impresion->delete();

        return redirect()->route('impresion')->with('success', 'Logo eliminado correctamente.');
    } else {
        return redirect()->route('impresion')->with('error', 'Error al eliminar el logo.');
    }
}
}
