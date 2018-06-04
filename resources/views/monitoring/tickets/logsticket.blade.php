@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Monitoring</a></li>
                        <li class="breadcrumb-item"><a href="#">Ticket Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Log Tickets</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10" scope="col">No</th>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Message</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ticketlogs AS $ticketlog)
                            <tr>
                                <th scope="row">{{ $loop->iteration + $offset }}</th>
                                <td align="center">{{ $ticketlog->ticket->ticket_id }}</td>
                                <td align="center">{{ $ticketlog->user->fullname }}</td>
                                <td align="center">
                                    @if($ticketlog->status == 1)
                                        {{ $ticketlog->user->fullname }} Open New Ticket ID : {{ $ticketlog->ticket->ticket_id }}
                                    @elseif($ticketlog->status == 2)
                                        {{ $ticketlog->user->fullname }} Processing Ticket ID : {{ $ticketlog->ticket->ticket_id }}
                                    @elseif($ticketlog->status == 3)
                                        {{ $ticketlog->user->fullname }} Pending Ticket ID : {{ $ticketlog->ticket->ticket_id }}
                                    @elseif($ticketlog->status == 4)
                                        {{ $ticketlog->user->fullname }} Close Ticket ID : {{ $ticketlog->ticket->ticket_id }}
                                    @endif
                                </td>
                                <td align="center">{{ $ticketlog->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" align="center"><b>No Record Found!</b></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <nav>
                    {{ $ticketlogs->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection