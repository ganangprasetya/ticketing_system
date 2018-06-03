@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Monitoring</a></li>
                        <li class="breadcrumb-item"><a href="#">Ticket Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Tickets</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col search-box">
                <form method="GET" class="form-inline col-12 justify-content-end">
                    <label for="filterBy">Search :</label>&nbsp;
                    <div class="form-group">
                        <select name="filter" class="custom-select" id="filterBy">
                            <option value="">Filter by</option>
                            <option value="company"{{ (Request::query('filter') == "company") ? ' selected':'' }}>Company</option>
                            <option value="status"{{ (Request::query('filter') == "status") ? ' selected':'' }}>Status</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-0 col-4">
                        <input type="search" name="keyword" class="form-control col-12" id="inputKeyword" placeholder="Keyword" value="{{ Request::query('keyword') }}">
                    </div>
                    <button type="submit" class="btn btn-dark">Search</button>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <table class="table table-hover" style="display: block;overflow-x: auto;white-space: nowrap;">
                    <thead>
                        <tr>
                            <th width="10" scope="col">
                                <div class="form-row">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" aria-label="..." id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </label>
                                </div>
                            </th>
                            <th width="10" scope="col">No</th>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Company</th>
                            <th scope="col">PIC Complaint</th>
                            <th scope="col">Date Complaint</th>
                            <th scope="col">Note Complaint</th>
                            <th scope="col">PIC Open</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th width="200" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets AS $ticket)
                            <tr onclick="toggleChecked('{{ $ticket->id }}')">
                                <th>
                                    <div class="form-row">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" aria-label="..." id="checkedValues{{ $ticket->id }}">
                                            <label class="custom-control-label" for="checkedValues{{ $ticket->id }}"></label>
                                        </label>
                                    </div>
                                </th>
                                <th scope="row">{{ $loop->iteration + $offset }}</th>
                                <td>{{ $ticket->ticket_id }}</td>
                                <td>{{ $ticket->company->name }}</td>
                                <td>{{ $ticket->pic_complaint }}</td>
                                <td>{{ $ticket->date_complaint }}</td>
                                <td>{{ str_limit($ticket->note, 20, '...') }}</td>
                                <td>{{ $ticket->user->fullname }}</td>
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
                                <td>{{ $ticket->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>{{ $ticket->updated_at->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm " title="Detail Ticket"><i class="fa fa-info-circle"></i></a>
                                    <a href="{{ route('companies.edit', $ticket->id) }}" class="btn btn-success btn-sm" title="Update Status Ticket"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" align="center"><b>No Record Found!</b></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <nav>
                    {{ $tickets->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    </script>
@endsection