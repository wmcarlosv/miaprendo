<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use Auth;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();

        return view('admin.lessons.index',['lessons' => $lessons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lessons.new');
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
            'title' => 'required'
        ]);

        $lesson = new Lesson();
        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->user_id = Auth::user()->id;
        $lesson->save();

        flash("Clase Registrada con Exito!!")->success();

        return redirect()->route('lessons.index');
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
        $lesson = Lesson::findorfail($id);

        return view('admin.lessons.edit',['lesson' => $lesson]);
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
            'title' => 'required'
        ]);

        $lesson = Lesson::findorfail($id);
        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->user_id = Auth::user()->id;
        $lesson->update();

        flash("Clase Actualizada con Exito!!")->success();

        return redirect()->route('lessons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findorfail($id);
        $lesson->delete();

        flash("Clase Eliminada con Exito!!")->success();

        return redirect()->route('lessons.index');
    }
}
