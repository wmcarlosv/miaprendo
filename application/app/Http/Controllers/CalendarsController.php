<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\Lesson;
use Auth;

class CalendarsController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendars = Calendar::all();

        return view('admin.calendars.index',['calendars' => $calendars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = Lesson::all();
        return view('admin.calendars.new',['lessons' => $lessons]);
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
            'lesson_date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'lesson_id' => 'required',
            'lesson_price' => 'required'
        ]);

        $calendar = new Calendar();
        $calendar->teacher_id = Auth::user()->id;
        $calendar->lesson_date = date('Y-m-d',strtotime($request->input('lesson_date')));
        $calendar->time_from = $request->input('time_from');
        $calendar->time_to = $request->input('time_to');
        $calendar->lesson_id = $request->input('lesson_id');
        $calendar->lesson_price = $request->input('lesson_price');
        $calendar->save();

        flash("Calendario Registrada con Exito!!")->success();

        return redirect()->route('calendars.index');
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
        $Calendar = Calendar::findorfail($id);

        return view('admin.calendars.edit',['Calendar' => $Calendar]);
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
            'lesson_date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'lesson_id' => 'required',
            'lesson_price' => 'required'
        ]);

        $calendar = Calendar::findorfail($id);
        $calendar->teacher_id = Auth::user()->id;
        $calendar->lesson_date = date('Y-m-d',strtotime($request->input('lesson_date')));
        $calendar->time_from = $request->input('time_from');
        $calendar->time_to = $request->input('time_to');
        $calendar->lesson_id = $request->input('lesson_id');
        $calendar->lesson_price = $request->input('lesson_price');
        $calendar->save();

        flash("Calendario Actualizado con Exito!!")->success();

        return redirect()->route('calendars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Calendar = Calendar::findorfail($id);
        $Calendar->delete();

        flash("Calendario Eliminado con Exito!!")->success();

        return redirect()->route('calendars.index');
    }
}
