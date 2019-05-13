<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Calendar;

class StudentsController extends Controller
{
    public function index()
    {
    	$students = User::where('role','=','estudiante')->get();
    	if(!isset($students) and empty($students)){
    		$students = [];
    	}
    	return view('admin.students.index',['students' => $students]);
    }

    public function create()
    {
    	return view('admin.students.new');
    }

    public function student_hours($id = NULL){
        $hours = Calendar::where('student_id','=',$id)->where('status','=','finalizado')->get();
        $plus_hourst = 0;
        if(!isset($hours) and empty($hours)){
            $hours = [];
        }

        foreach ($hours as $h) {
           
        }
    }
}
