<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthdate = date('Y-m-d',strtotime($request->input('birthdate')));
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->address = $request->input('address');
        $user->save();

        if($request->input('role') == 'profesor'){
            flash('Profesor Registrado con Exito')->success();
            return redirect()->route('teachers.index');
        }

        if($request->input('role') == 'estudiante'){
            flash('Estudiante Registrado con Exito')->success();
            return redirect()->route('students.index');
        }

        if($request->input('role') == 'administrador'){
            flash('Administrador Registrado con Exito')->success();
            return redirect()->route('administrators.index');
        }
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
        $user = User::findorfail($id);

        if($user->role == "profesor"){
            return view('admin.teachers.edit',['teacher' => $user]);
        }

        if($user->role == "estudiante"){
            return view('admin.students.edit',['student' => $user]);
        }

        if($user->role == "administrador"){
            return view('admin.administrators.edit',['administrator' => $user]);
        }
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
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::findorfail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthdate = date('Y-m-d',strtotime($request->input('birthdate')));
        $user->role = $request->input('role');
        $user->address = $request->input('address');
        $user->save();

        if($request->input('role') == 'profesor'){
            flash('Profesor Actualizado con Exito')->success();
            return redirect()->route('teachers.index');
        }

        if($request->input('role') == 'estudiante'){
            flash('Estudiante Actualizado con Exito')->success();
            return redirect()->route('students.index');
        }

        if($request->input('role') == 'administrador'){
            flash('Administrador Actualizado con Exito')->success();
            return redirect()->route('administrators.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        $role = $user->role;
        $user->delete();

        if($role == "profesor"){
            flash("Profesor Eliminado con Exito!!")->success();
            return redirect()->route("teachers.index");
        }

        if($role == "estudiante"){
            flash("Estudiante Eliminado con Exito!!")->success();
            return redirect()->route("students.index");
        }

        if($role == "administrador"){
            flash("Administrador Eliminado con Exito!!")->success();
            return redirect()->route("administrators.index");
        }
    }

    public function profile(){

        return view('admin.users.profile');
    }

    public function change_password(Request $request, $id){

        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::findorfail($id);
        $user->password = bcrypt($request->input('password'));
        $user->save();

        flash("Contraseña Actualizada con Exito!!")->success();

        return redirect()->route('users.profile');
    }
}
