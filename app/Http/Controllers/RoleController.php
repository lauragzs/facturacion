<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index(){
        $rol= Role::all();
        //dd($rol);
        return view('Rol.rol',['rol'=>$rol]);
    }
    //SHOW
    public function show($id){
        $rol = Role::findOrFail($id);
        return view('Rol.rol_ver',['rol' => $rol]);
    }
    //DELETE
    public function destroy($id){
        //
        $rol=Role::findOrFail($id);
        //dd($rol);
        $rol->delete();
        return redirect()->action([RoleController::class,'index']);
    }
    //CREATE
    public function create(){
        //
        return view('Rol.rol_crear');
    }
    //STORE
    public function store(Request $request){
        //
        $rol= new Role($request->all());
        $rol->save();
        return redirect()->action([RoleController::class, 'index']);
    }
    //EDIT
    public function edit($id){
        //
        $rol= Role::findOrFail($id);
        //$rol=DB::table('rol')->where('id','=',$id)->get();
        return view('Rol.rol_editar',['rol'=>$rol]);
    }
    //UPDATE
    public function update(Request $request, $id){
        //
        $rol = Role::findOrFail($id);
        $rol->name = $request ->name;
        $rol->guard_name = $request ->guard_name;
        $rol->save();
        return redirect()->action([RoleController::class, 'index']);
    }
}
