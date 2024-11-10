<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Tipo_documento;
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    // Método para buscar clientes por NIT
    public function buscarPorNit(Request $request)
    {
        // Inicializar las variables para evitar errores
        $razonSocial = '';
        $email = '';
        $nit = '';

        // Verificar si se proporcionó un NIT para buscar
        if ($request->filled('nit')) {
            // Buscar el usuario por NIT en la base de datos
            $usuario = User::where('nit', $request->input('nit'))->first();

            if ($usuario) {
                // Asignar datos del usuario al formulario de creación
                $razonSocial = $usuario->razon_social;
                $email = $usuario->email;
                $nit = $usuario->nit;
            }
        }

        // Obtener tipos de documento
        $tipodoc = Tipo_documento::all();

        return view('Cliente.cliente', [
            'razonSocial' => $razonSocial,
            'email' => $email,
            'nit' => $nit,
            'tipodoc' => $tipodoc,
            'usuario' => Auth::user()
        ]);
    }

    // Método para guardar un nuevo cliente
    public function store(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'razon_social' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'celular' => 'required|numeric',
            'telefono' => 'nullable|numeric',
            'nit' => 'required|string|max:12|unique:clientes,nit',
            'tipodoc_id' => 'required|exists:tipo_documentos,id',
        ]);

        // Crear y guardar el nuevo cliente
        $cliente = new Cliente($validatedData);
        $cliente->id_user = Auth::id(); // Asigna el ID del usuario autenticado

        // Intentar guardar el cliente y manejar errores
        try {
            $cliente->save();
            return redirect()->route('cliente')->with('success', 'Cliente guardado exitosamente.');
        } catch (\Exception $e) {
            \Log::error('Error al guardar el cliente: ' . $e->getMessage());
            return redirect()->route('cliente')->with('error', 'Error al guardar el cliente.');
        }
    }

    // Index: Mostrar todos los clientes
    public function index()
    {
        $tipodoc = Tipo_documento::all(); // Obtener los tipos de documento
        $usuario = Auth::user(); // Obtener el usuario autenticado

        // Inicializar variables para la vista
        $razonSocial = '';
        $email = '';
        $nit = '';

        return view('Cliente.cliente', [
            'razonSocial' => $razonSocial,
            'email' => $email,
            'nit' => $nit,
            'tipodoc' => $tipodoc,
            'usuario' => $usuario // Pasar el usuario autenticado a la vista
        ]);
    }
}
