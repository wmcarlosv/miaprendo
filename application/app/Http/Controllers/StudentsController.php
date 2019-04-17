<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
