<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdministratorsController extends Controller
{
    public function index()
    {
    	$administrators = User::where('role','=','administrador')->get();
    	if(!isset($administrators) and empty($administrators)){
    		$administrators = [];
    	}
    	return view('admin.administrators.index',['administrators' => $administrators]);
    }

    public function create()
    {
    	return view('admin.administrators.new');
    }
}
