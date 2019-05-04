<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class TeachersController extends Controller
{
    public function index()
    {
    	$teachers = User::where('role','=','profesor')->get();
    	if(!isset($teachers) and empty($teachers)){
    		$teachers = [];
    	}

    	return view('admin.teachers.index',['teachers' => $teachers]);
    }

    public function create()
    {
    	return view('admin.teachers.new');
    }

    public function hours(){
        $hours = DB::select(DB::raw('select u.name as teacher, date_format(c.lesson_date, "%m-%Y") as ldate, sum(lesson_price) as hours from calendars as c 
                                     inner join users as u on (c.teacher_id = u.id)
                                     where u.role = "profesor" group by date_format(c.lesson_date, "%m-%Y"), u.name'));

        return view('admin.teachers.hours',['hours' => $hours]);
    }
}
