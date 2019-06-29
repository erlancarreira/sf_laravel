<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function rolesPermission() 
    {
        $nameUser = auth()->user()->name;
        echo "<h1> {$nameUser} </h1>";
        foreach (auth()->user()->roles as $role) {
            echo "<b>$role->name</b>";

            $permissions = $role->permissions;
            foreach ($permissions as $permission) {
                echo " > $permission->name";
            }

            echo "<hr>";
        }
    }
}
