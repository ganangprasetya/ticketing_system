<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use Carbon\Carbon;
use DB;

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
        $opentickets = Ticket::where('status',1)->get()->count();
        $pendingtickets = Ticket::where('status',3)->get()->count();
        $processtickets = Ticket::where('status',2)->get()->count();
        $closetickets = Ticket::where('status',4)->get()->count();
        return view('dashboard', compact('opentickets','pendingtickets','processtickets','closetickets'));
    }
}
