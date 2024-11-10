<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AsignarController extends Controller
{
    //
    public function index(){
        //
        $user = User::all();
        $roles = Role::all();

        return view('userpermi',['users'=> $user],['role'=>$roles]);
    }
    public function edit(string $id){
        //
        $users = User::find($id);
        $roles = Role::all();

        return view('asignar_rol',['user'=>$users],['role'=>$roles]);
    }
    public function update(Request $request, string $id){
        //
        $users = User::find($id);
        $users->roles()->sync($request->roles);
        return redirect()->action([AsignarController::class, 'index']);
    }
}
