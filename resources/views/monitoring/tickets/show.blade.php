@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/jquery.emojipicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/jquery.emojipicker.g.css') }}">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Monitoring</a></li>
                        <li class="breadcrumb-item"><a href="#"><Title>Ticket Management</Title></a></li>
                        <li class="breadcrumb-item"><a href="#">Manage Tickets</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Ticket {{ $ticket->ticket_id }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="module">
	    		<div class="module-head">
                    <h3>{{ $ticket->ticket_id }}</h3>
                </div>
                <div class="module-body">
		            <table class="table table-striped">
                        <tr>
                            <th>Company</th>
                            <th>:</th>
                            <td>{{ $ticket->company->name }}</td>
                        </tr>
                        <tr>
                            <th>PIC Complaint</th>
                            <th>:</th>
                            <td>{{ $ticket->pic_complaint }}</td>
                        </tr>
                        @php
                            $date_complaint = date_create($ticket->date_complaint);
                        @endphp
                        <tr>
                            <th>Date Complaint</th>
                            <th>:</th>
                            <td>{{ date_format($date_complaint, 'd-m-Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Note Complaint</th>
                            <th>:</th>
                            <td>{{ $ticket->note }}</td>
                        </tr>
                        <tr>
                            <th>PIC Open</th>
                            <th>:</th>
                            <td>{{ $ticket->user->fullname }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td>
                                @if($ticket->status == 1)
                                    <span class="badge badge-pill badge-success">Open</span>
                                @elseif($ticket->status == 2)
                                    <span class="badge badge-pill badge-secondary">Process</span>
                                @elseif($ticket->status == 3)
                                    <span class="badge badge-pill badge-warning">Pending</span>
                                @elseif($ticket->status == 4)
                                    <span class="badge badge-pill badge-danger">Closed</span>
                                @endif    
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <th>:</th>
                            <td>{{ $ticket->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>PIC Update 1</th>
                            <th>:</th>
                            <td>{{ (!$ticket->picupdate) ? '-':$ticket->picupdate->fullname}}</td>
                        </tr>
                        <tr>
                            <th>PIC Update 2</th>
                            <th>:</th>
                            <td>{{ (!$ticket->picupdate2) ? '-':$ticket->picupdate2->fullname}}</td>
                        </tr>
                        <tr>
                            <th>PIC Update 3</th>
                            <th>:</th>
                            <td>{{ (!$ticket->picupdate3) ? '-':$ticket->picupdate3->fullname}}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <th>:</th>
                            <td>{{ $ticket->updated_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
