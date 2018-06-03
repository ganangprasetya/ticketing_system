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
    public function index(request $request)
    {
        $paginate_limit = env('PAGINATE_LIMIT', 10);

        // search roles
        $tickets = Ticket::latest()->paginate($paginate_limit);
        if (count($request->query()) > 0) {
            $filter = $request->query('filter');
            $keyword = $request->query('keyword');

            switch ($filter) {
                case "name":
                    $tickets = Company::where('name', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
                    break;
                default:
                    $tickets = Company::where('name', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
            }
        }
        $offset = $tickets->perPage() * ($tickets->currentPage() - 1);

        return view(self::VIEW_PATH . '.index')->with(compact('tickets', 'offset'));
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
        $request->validate([
            'company' => 'required',
            'pic_complaint' => 'required|string|max:255',
            'date_complaint' => 'required',
            'note' => 'string|nullable|max:255'
        ]);
        $user_id = Auth::user()->id;
        //prepare number of ticket
        $last_ticket = Ticket::latest()->first();
        if($last_ticket == NULL){
            $new_number = 1;
        }else{
            $strArray = explode('-', $last_ticket->ticket_id);
            $no = $strArray[1];
            $new_number = $no + 1;
        }
        $new_ticket = $new_number;
        $prepare_ticket = Library::generateTicketId();
        $ticket_id = $prepare_ticket.$new_ticket;
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
