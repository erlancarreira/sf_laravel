<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_id', auth()->user()->id)->get();
               
        return view('admin.panel.user.list.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {        
        //Role::where('user_id', auth()->user()->id)->get();
        return view('admin.panel.user.index');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id'     => 'exists:user_id',
            'name'   => 'required|string',
            'email'  => 'required|unique:users,email',
            'phone'  => 'required|integer|unique:users,phone'
        ]);
        
        $user = new User;
    
        $user->name    = $request->name;
        $user->phone   = $request->phone;
        $user->email   = $request->email;
        $user->user_id = auth()->user()->id;
        $user->save();
        
        //$user->roles()->attach($user->id, ['role_id' => $request->role_id]); 
        
        return redirect('/admin/usuario-cadastrar');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    { 
        $user = $user->where('id', $user->id)->with('roles')->first();
          
        return view('admin.panel.user.edit.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->except(['_token']));
        
        return redirect('/admin/usuarios-listar')->with('success', 'Usuario atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
      
        return redirect('/admin/usuarios-listar');  
    }
}
