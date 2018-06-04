<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Alert;
use Library;
use Excel;
use App\Ticket;
use App\TicketLog;
use App\User;
use App\Company;
use Carbon\Carbon;
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
            'pic_complaint' => 'required|string',
            'date_complaint' => 'required',
            'note' => 'string|nullable'
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
        $ticketlog = TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user_id
        ]);
        alert()->success('Ticket ' . $ticket_id . ' has been added!', 'Success');
        return redirect()->route('tickets.manage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function logs()
    {
        $ticketlogs = TicketLog::latest()->paginate(10);
        $offset = $ticketlogs->perPage() * ($ticketlogs->currentPage() - 1);

        return view(self::VIEW_PATH.'.logsticket', compact('ticketlogs', 'offset'));
    }

    public function detail($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view(self::VIEW_PATH.'.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $companies = Company::latest()->get();
        $status = [1,2,3,4];
        return view(self::VIEW_PATH . '.edit')->with(compact('ticket','companies','status'));
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
        $ticket = Ticket::findOrFail($id);
        $user_id = Auth::user()->id;
        $request->validate([
            'company' => 'required',
            'pic_complaint' => 'required|string',
            'date_complaint' => 'required',
            'note' => 'string|nullable',
            'status' => 'required'
        ]);
        if($ticket->status == 2 AND $request->status == 1){
            alert()->warning('Ticket ' . $ticket->ticket_id . ' Already Processed!', 'Warning');
        }elseif($ticket->status == 3 AND $request->status == 1){
            alert()->warning('Ticket ' . $ticket->ticket_id . ' Already Pending!', 'Warning');
        }else{
            $ticket->company_id = $request->company;
            $ticket->user_id = $user_id;
            $ticket->pic_complaint = $request->pic_complaint;
            $ticket->date_complaint = $request->date_complaint;
            $ticket->date_complaint = $request->date_complaint;
            $ticket->note = $request->note;
            $ticket->status = $request->status;
            if($request->status == 2){
                $ticket->pic_update = $user_id;
            }elseif($request->status == 3){
                $ticket->pic_update_2 = $user_id;
            }elseif($request->status == 4){
                $ticket->pic_update_3 = $user_id;
                $ticket->save();
                alert()->success('Ticket ' . $ticket->ticket_id . ' has been closed!', 'Success');
                return redirect()->route('tickets.manage');
            }
            $ticket->save();
            alert()->success('Ticket ' . $ticket->ticket_id . ' has been updated!', 'Success');
        }
        return back();
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
