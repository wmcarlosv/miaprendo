<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
