<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usersByMonth = $this->getUsersByMonth();
        $roles = $this->getRoles();
        $usersByDay = $this->getUsersByDay();

        return view('home', compact('usersByMonth', 'roles', 'usersByDay'));
    }

    private function getUsersByMonth()
    {
        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
                    ->groupBy('month')
                    ->get();

        $months = [];
        $userCounts = [];

        foreach ($users as $user) {
            $months[] = date('F', mktime(0, 0, 0, $user->month, 1));
            $userCounts[] = $user->count;
        }

        return compact('months', 'userCounts');
    }

    private function getRoles()
    {
        $roles = Rol::select(DB::raw("COUNT(*) as count"), 'nombre')
                    ->groupBy('nombre')
                    ->get();

        $nombresRoles = [];
        $rolCounts = [];

        foreach ($roles as $rol) {
            $nombresRoles[] = $rol->nombre;
            $rolCounts[] = $rol->count;
        }

        return compact('nombresRoles', 'rolCounts');
    }

    private function getUsersByDay()
    {
        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("DATE(created_at) as date"))
                    ->groupBy('date')
                    ->get();

        $days = [];
        $userCounts = [];

        foreach ($users as $user) {
            $days[] = $user->date;
            $userCounts[] = $user->count;
        }

        return compact('days', 'userCounts');
    }
}

