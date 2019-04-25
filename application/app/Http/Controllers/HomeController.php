<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $calendars = Calendar::all();

        $students = User::where('role','=','estudiante')->get();
        if(!isset($students) and empty($students)){
            $students = [];
        }
        $sc = $students->count();

        $teachers = User::where('role','=','profesor')->get();
        if(!isset($teachers) and empty($teachers)){
            $teachers = [];
        }
        $tc = $teachers->count();

        return view('home',['calendars' => $calendars,'sc' => $sc, 'tc' => $tc]);
    }
}
