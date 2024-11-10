<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    //
    public function index(){
        $silla = Rol::all();
        //dd($variable);
        return view('Roles.rol',['silla'=>$silla]);
    }
    public function show($id){
        $rol = Rol::findOrFail($id);
        return view('Roles.rol_ver', ['rol'=>$rol]);
    }
    public function destroy($id){
        $rol = Rol::findOrFail($id);
        $rol->delete();
        return redirect()->action([RolController::class, 'index']);
    }
    public function create(){
        return view('Roles.rol_crear');
    }
    public function store(Request $request){
        $rol=new Rol($request->all());
        $rol->save();
        return redirect()->action([RolController::class, 'index']);
    }
    public function edit($id){
        $rol = Rol::findOrFail($id);
        return view('Roles.rol_editar',['rol'=>$rol]);
    }
    public function update(Request $request, $id){
        $rol = Rol::findOrFail($id);
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->save();
        return redirect()->action([RolController::class, 'index']);
    }
}
