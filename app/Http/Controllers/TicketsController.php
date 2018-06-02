<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Alert;
use Library;
use Excel;
use App\Ticket;
use App\User;
use App\Company;
use Auth;

class TicketsController extends Controller
{
    const VIEW_PATH = "monitoring.tickets";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::latest()->get();
        return view(self::VIEW_PATH . '.create')->with(compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $ticket = Ticket::latest()->first()->ticket_id;
        $ticket_id = Library::generateTicketId();
        return $ticket_id;
        $request->validate([
            'ticket_id' => 'required|string|max:255',
            'company' => 'required',
            'pic_complaint' => 'required|string|max:255',
            'date_complaint' => 'required',
            'note' => 'string|nullable|max:255'
        ]);
        $ticket = Ticket::create([
            'ticket_id' => $ticket_id,
            'company_id' => $request->company,
            'pic_complaint' => $request->pic_complaint,
            'date_complaint' => $request->date_complaint,
            'note' => $request->note,
            'user_id' => $user_id
        ]);
        alert()->success('Ticket ' . $ticket_id . ' has been added!', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
