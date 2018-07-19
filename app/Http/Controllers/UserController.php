<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Response;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users= User::with('roles')->get();
      //dd($users);
      return Response::json($users);

    }

    public function getRoleId(){
      $role_id = Auth::user()->roles->id;
      //dd($user);
      return Response::json($role_id);
    }
    public function getRoles(){
      $roles = Role::all();
      //dd($user);
      return Response::json($roles);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required'    => 'se requiere nombre',
            'rol.required'    => 'se requiere rol',
            'email.required' => 'se require Email',
            'email.email' => 'no tiene formato de correo',
            'email.unique' => 'el correo ya existe',
            'password.required'      => 'se require password',
        ];
        $request->validate([
            'name' => 'required|string',
            'rol' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ],$messages);
        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->rol;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $users= User::with('roles')->get();
        //dd($users);
        return Response::json($users);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $messages = [
          'name.required'    => 'se requiere nombre',
          'rol.required'    => 'se requiere rol',
          'email.required' => 'se require Email',
          'email.email' => 'no tiene formato de correo',


      ];
      $request->validate([
          'name' => 'required|string',
          'rol' => 'required',
          'email' => 'required|email'

      ],$messages);
      $user = User::find($id);
      $user->name = $request->name;
      $user->role_id = $request->rol;
      $user->email = $request->email;
      if($request->password != ''){
        $user->password = bcrypt($request->password);
      }
      $user->save();
      $users= User::with('roles')->get();
      //dd($users);
      return Response::json($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      $user->delete();
      $users= User::with('roles')->get();
      //dd($users);
      return Response::json($users);
    }
}
