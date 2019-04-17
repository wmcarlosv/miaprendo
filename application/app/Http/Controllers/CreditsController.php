<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credit;
use App\User;
use Auth;

class CreditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = Credit::all();

        return view('admin.credits.index',['credits' => $credits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::where('role','=','estudiante')->get();
        if(isset($students) and empty($students)){
            $students = [];
        }
        return view('admin.credits.new',['students' => $students]);
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
            'student_user_id' => 'required',
            'amount' => 'required'
        ]);

        $credit = new Credit();
        $credit->admin_user_id = Auth::user()->id;
        $credit->student_user_id = $request->input('student_user_id');
        $credit->amount = $request->input('amount');
        $credit->save();

        //Actualizar Credito en Estudiante
        $user = User::findorfail($request->input('student_user_id'));
        $amount = ($user->credit+$request->input('amount'));
        $user->credit = $amount;
        $user->update();
        //Fin Actualizar Clase

        flash("Credito Registrado con Exito!!")->success();

        return redirect()->route('credits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credit = Credit::findorfail($id);

        return view('admin.credits.show',['credit' => $credit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
