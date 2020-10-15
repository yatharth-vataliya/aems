<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solo=Event::getSoloEvent();
        $group=Event::getGroupEvent();
        $other=Event::getOtherEvent();
        return view('home',['solo'=>$solo,'group'=>$group,'other'=>$other]);
    }
}
