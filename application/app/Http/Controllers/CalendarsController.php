<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\Lesson;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class CalendarsController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendars = Calendar::where('teacher_id','=',Auth::user()->id)->get();

        if(!isset($calendars) and empty($calendars)){

            $calendars = [];

        }

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

        $students = User::where('role','=','estudiante')->get();
        if(!isset($students) and empty($students)){
            $students = [];
        }

        $teachers = User::where('role','=','profesor')->get();
        if(!isset($teachers) and empty($teachers)){
            $teachers = [];
        }

        return view('admin.calendars.new',['lessons' => $lessons, 'students' => $students, 'teachers' => $teachers]);
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
            'teacher_id' => 'required',
            'student_id' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'lesson_id' => 'required'
        ]);

        $student = User::findorfail($request->input('student_id'));

        if($student->credit >= $request->input('lesson_price')){

            $hours = ($student->credit - $request->input('lesson_price'));

            $calendar = new Calendar();
            $calendar->teacher_id = $request->input('teacher_id');
            $calendar->lesson_date = date('Y-m-d',strtotime($request->input('lesson_date')));
            $calendar->time_from = date('H:m:s',strtotime($request->input('time_from')));
            $calendar->time_to = date('H:m:s',strtotime($request->input('time_to')));
            $calendar->lesson_id = $request->input('lesson_id');
            $calendar->student_id = $request->input('student_id');
            $calendar->lesson_price = $request->input('lesson_price');
            $calendar->status = 'aprobado';
            $calendar->save();

            //Actualizar credito en estudiante
            $student->credit = $hours;
            $student->update();

            flash("Calendario Registrada con Exito!!")->success();
            return redirect()->route('list.calendars');
        }else{
            flash("La cantidad de horas solicitadas supera las horas que tiene disponible!!")->error();
            return redirect()->route('calendars.create');
        }   

    }

    public function repeat_calendar($id = NULL){

        $calendar = Calendar::findorfail($id);

        $lessons = Lesson::all();
        $students = User::where('role','=','estudiante')->get();
        if(!isset($students) and empty($students)){
            $students = [];
        }

        $teachers = User::where('role','=','profesor')->get();
        if(!isset($teachers) and empty($teachers)){
            $teachers = [];
        }

        return view('admin.calendars.repeat',['lessons' => $lessons, 'students' => $students, 'teachers' => $teachers, 'calendar' => $calendar]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calendar = Calendar::findorfail($id);

        return view('admin.calendars.show',['calendar' => $calendar]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendar = Calendar::findorfail($id);
        $students = User::where('role','=','estudiante')->get();
        if(!isset($students) and empty($students)){
            $students = [];
        }

        return view('admin.calendars.edit',['calendar' => $calendar, 'students' => $students]);
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
            'status' => 'required'
        ]);

        $calendar = Calendar::findorfail($id);
        $calendar->status = $request->input('status');

        $calendar->save();

        flash("Calendario Actualizado con Exito!!")->success();

        return redirect()->route('list.calendars');
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

    public function list_calendars(){

        $calendars = Calendar::all();

        return view('admin.calendars.administrator',['calendars' => $calendars]);

    }

    public function my_lessons(){

        $calendars = Calendar::where('student_id','=',Auth::user()->id)->get();

        if(!isset($calendars) and empty($calendars)){
            $calendars = [];
        }

        return view('admin.calendars.student',['calendars' => $calendars]);
    }

    public function end_lesson(Request $request, $id = NULL){

        $calendar = Calendar::findorfail($id);

        if($request->hasFile('document')){

            $calendar->document = $request->document->store('documents');
        }else{
            $calendar->document = NULL;

        }
        $calendar->observation = $request->input('observation');
        $calendar->status = 'finalizado';

        $calendar->update();

        flash("Documento Subido con Exito!! la clase se marco como finalziada!!")->success();

        return redirect()->route('calendars.index');
    }

    public function show_student($id){
        $calendar = Calendar::findorfail($id);
        return view('admin.calendars.show_student',['calendar' => $calendar]);
    }

    public function add_student(Request $request, $id){

        $request->validate([
            'lesson_price' => 'required'
        ]);

        if(Auth::user()->credit >= $request->input('lesson_price')){
            $calendar = Calendar::findorfail($id);
            $calendar->student_id = Auth::user()->id;
            $calendar->lesson_price = $request->input('lesson_price');
            $calendar->update();
            flash("Clase Apartada con Exito, Debe esperar aprobacion del Administrador!!")->success();
        }else{
            flash("La cantidad de horas solicitadas supera las horas que tiene disponible!!")->error();
        }

        return redirect()->route('my.lessons');
    }
}
