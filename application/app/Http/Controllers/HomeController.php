<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use Auth;

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
        
        return view('home',['calendars' => $calendars]);
    }
}
