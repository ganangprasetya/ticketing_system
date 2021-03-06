@extends('layouts.app')

@section('content')
    <div class="container">
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
                                        Open New Ticket ID : {{ $ticketlog->ticket->ticket_id }}
                                    @elseif($ticketlog->status == 2)
                                        Processing Ticket ID : {{ $ticketlog->ticket->ticket_id }}
                                    @elseif($ticketlog->status == 3)
                                        Pending Ticket ID : {{ $ticketlog->ticket->ticket_id }}
                                    @elseif($ticketlog->status == 4)
                                        Close Ticket ID : {{ $ticketlog->ticket->ticket_id }}
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