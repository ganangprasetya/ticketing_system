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
            $status = $request->query('status');
            $keyword = $request->query('keyword');

            switch ($filter) {
                case "status":
                    $tickets = Ticket::where('status',$status)->latest()->paginate($paginate_limit);
                    $tickets->appends([
                        'filter' => $filter,
                        'status' => $status,
                    ]);
                    break;
                case "company":
                    $company = Company::where('name', 'like', '%' . $keyword . '%')->first();
                    if($company == NULL){
                        $tickets = Ticket::where('company_id', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
                    }else{
                        $tickets = Ticket::where('company_id',$company->id)->latest()->paginate($paginate_limit);
                    }
                    $tickets->appends([
                        'filter' => $filter,
                        'keyword' => $keyword,
                    ]);
                    break;
                case "picopen":
                    $user = User::where('fullname', 'like', '%' . $keyword . '%')->first();
                    if($user == NULL){
                        $tickets = Ticket::where('user_id', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
                    }else{
                        $tickets = Ticket::where('user_id',$user->id)->latest()->paginate($paginate_limit);
                    }
                    $tickets->appends([
                        'filter' => $filter,
                        'keyword' => $keyword,
                    ]);
                    break;
                // default:
                //     $tickets = Ticket::where('name', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
            }
        }
        $offset = $tickets->perPage() * ($tickets->currentPage() - 1);

        return view(self::VIEW_PATH . '.index')->with(compact('tickets', 'offset'));
    }

    public function lists(request $request)
    {
        $paginate_limit = env('PAGINATE_LIMIT', 10);

        // search roles
        $tickets = Ticket::latest()->paginate($paginate_limit);
        if (count($request->query()) > 0) {
            $filter = $request->query('filter');
            $status = $request->query('status');
            $keyword = $request->query('keyword');

            switch ($filter) {
                case "status":
                    $tickets = Ticket::where('status',$status)->latest()->paginate($paginate_limit);
                    $tickets->appends([
                        'filter' => $filter,
                        'status' => $status,
                    ]);
                    break;
                case "company":
                    $company = Company::where('name', 'like', '%' . $keyword . '%')->first();
                    if($company == NULL){
                        $tickets = Ticket::where('company_id', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
                    }else{
                        $tickets = Ticket::where('company_id',$company->id)->latest()->paginate($paginate_limit);
                    }
                    $tickets->appends([
                        'filter' => $filter,
                        'keyword' => $keyword,
                    ]);
                    break;
                case "picopen":
                    $user = User::where('fullname', 'like', '%' . $keyword . '%')->first();
                    if($user == NULL){
                        $tickets = Ticket::where('user_id', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
                    }else{
                        $tickets = Ticket::where('user_id',$user->id)->latest()->paginate($paginate_limit);
                    }
                    $tickets->appends([
                        'filter' => $filter,
                        'keyword' => $keyword,
                    ]);
                    break;
                // default:
                //     $tickets = Company::where('name', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
            }
        }
        $offset = $tickets->perPage() * ($tickets->currentPage() - 1);

        return view(self::VIEW_PATH . '.list')->with(compact('tickets', 'offset'));
    }

    public function exportxls()
    {
        $tickets = Ticket::latest()->get();
        $excel = Excel::create('Data Ticket Complaints '.date('d-M-Y His'), function($excel) use($tickets){
            //Set Property
            $excel->setTitle('Data Ticket Complaints')
                  ->setCreator(Auth::user()->name);
            //memberi nama Sheet
            $excel->sheet('Data Ticket Complaints', function($sheet) use($tickets){
                $row = 1;
                //style sheeet excel
                $sheet->freezeFirstRow();
                //memakai border untuk header
                $sheet->cells('A1:N1', function($cells) {
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14'
                    ));
                    $cells->setBorder('A1:N1', 'thin');
                });
                //header
                $sheet->row($row,[
                    'No.',
                    'Ticket ID',
                    'Company',
                    'PIC Complaint',
                    'Date Complaint',
                    'Note Complaint',
                    'PIC Open',
                    'Status',
                    'PIC Update 1',
                    'PIC Update 2',
                    'PIC Update 3',
                    'Solution',
                    'Created At',
                    'Last Updated'
                ]);
                $no = 1;
                foreach($tickets as $ticket){
                    //if empty pic yg update
                    if($ticket->picupdate == NULL){
                        $picupdate = "-";
                    }else{
                        $picupdate = $ticket->picupdate->fullname;
                    }
                    if($ticket->picupdate2 == NULL){
                        $picupdate2 = "-";
                    }else{
                        $picupdate2 = $ticket->picupdate2->fullname;
                    }
                    if($ticket->picupdate3 == NULL){
                        $picupdate3 = "-";
                    }else{
                        $picupdate3 = $ticket->picupdate->fullname;
                    }

                    //condition status
                    if($ticket->status == 1){
                        $status = "Open";
                    }elseif($ticket->status == 2){
                        $status = "Process";
                    }elseif($ticket->status == 3){
                        $status = "Pending";
                    }elseif($ticket->status == 4){
                        $status = "Close";
                    }
                    $date_complaint = date_create($ticket->date_complaint);
                    $sheet->row(++$row, [
                        $no++,
                        $ticket->ticket_id,
                        $ticket->company->name,
                        $ticket->pic_complaint,
                        date_format($date_complaint, 'd-m-Y H:i'),
                        $ticket->note,
                        $ticket->user->fullname,
                        $status,
                        $picupdate,
                        $picupdate2,
                        $picupdate3,
                        $ticket->note_completion,
                        $ticket->created_at->format('d-m-Y H:i'),
                        $ticket->updated_at->format('d-m-Y H:i')
                    ]);
                }
            });
        })->download('xlsx');
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
            'note_completion' => 'string|nullable',
            'status' => 'required'
        ]);
        if($ticket->status == 2 AND $request->status == 1){
            alert()->warning('Ticket ' . $ticket->ticket_id . ' Already Processed!', 'Warning');
        }elseif($ticket->status == 3 AND $request->status == 1){
            alert()->warning('Ticket ' . $ticket->ticket_id . ' Already Pending!', 'Warning');
        }elseif($ticket->status == 4 AND $request->status == 3){
            alert()->warning('Ticket ' . $ticket->ticket_id . ' Already Closed!', 'Warning');
        }elseif($ticket->status == 4 AND $request->status == 2){
            alert()->warning('Ticket ' . $ticket->ticket_id . ' Already Closed!', 'Warning');
        }elseif($ticket->status == 4 AND $request->status == 1){
            alert()->warning('Ticket ' . $ticket->ticket_id . ' Already Closed!', 'Warning');
        }else{
            $ticket->company_id = $request->company;
            $ticket->pic_complaint = $request->pic_complaint;
            $ticket->date_complaint = $request->date_complaint;
            $ticket->date_complaint = $request->date_complaint;
            $ticket->note = $request->note;
            $ticket->note_completion = $request->note_completion;
            $ticket->status = $request->status;
            if($request->status == 2){
                $ticket->pic_update = $user_id;
                $ticketlog = TicketLog::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user_id,
                    'status' => 2
                ]);
            }elseif($request->status == 3){
                $ticket->pic_update_2 = $user_id;
                $ticketlog = TicketLog::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user_id,
                    'status' => 3
                ]);
            }elseif($request->status == 4){
                $ticket->pic_update_3 = $user_id;
                $ticketlog = TicketLog::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user_id,
                    'status' => 4
                ]);
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
