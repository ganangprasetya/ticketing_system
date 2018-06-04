@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Monitoring</a></li>
                        <li class="breadcrumb-item"><a href="#">Ticket Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Status</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-left">Edit Ticket {{ $ticket->ticket_id }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="w-25"><label for="company" class="col-form-label">Company *</label></td>
                                <td>
                                    <select class="selectize {{ ($errors->has('database')) ? ' is-invalid':'' }}" name="company" required>
                                        <option value="">Select Company..</option>
                                        @foreach($companies as $company)
                                        <option value="{{$company->id}}" {{ Library::compareOption($company->id, old('database_id', $ticket->company->id)) }}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @if($errors->has('company'))
                                            {{ $errors->first('company') }}
                                        @else
                                            Company is required.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="pic_complaint" class="col-form-label">PIC Complaint *</label></td>
                                <td>
                                    <textarea name="pic_complaint" class="col-8 form-control{{ ($errors->has('pic_complaint')) ? ' is-invalid':'' }}" id="pic_complaint" placeholder="PIC Complaint">{{ old('pic_complaint',$ticket->pic_complaint) }}</textarea>
                                    <div class="invalid-feedback">
                                        @if($errors->has('pic_complaint'))
                                            {{ $errors->first('pic_complaint') }}
                                        @else
                                            PIC Complaint is required.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-25"><label for="date_complaint" class="col-form-label">Date Complaint *</label></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group datepicker">
                                            <input type="text" name="date_complaint" class="col-7 form-control datetimepicker bg-white{{ ($errors->has('date_complaint')) ? ' is-invalid':'' }}" value="{{ old('date_complaint',$ticket->date_complaint) }}" required data-input/>
                                            <span class="input-group-append">
                                                <span class="input-group-text input-button" title="toggle" data-toggle><i class="fa fa-calendar"></i></span>
                                                <span class="input-group-text input-button" title="clear" data-clear><i class="fa fa-times"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        @if($errors->has('date_complaint'))
                                            {{ $errors->first('date_complaint') }}
                                        @else
                                            Date Complaint is required.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="note" class="col-form-label">Note Complaint</label></td>
                                <td>
                                    <textarea name="note" class="col-8 form-control{{ ($errors->has('note')) ? ' is-invalid':'' }}" id="note" placeholder="Note Complaint">{{ old('note',$ticket->note) }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-25"><label for="status" class="col-form-label">Status *</label></td>
                                <td>
                                    <select class="selectize {{ ($errors->has('database')) ? ' is-invalid':'' }}" name="status" required>
                                        <option value="">Select Status..</option>
                                        @foreach($status as $value)
                                            <option value="{{ $value }}" {{ Library::compareOption($value, old('database_id', $ticket->status)) }}>
                                                @if($value == 1)
                                                    Open
                                                @elseif($value == 2)
                                                    Process
                                                @elseif($value == 3)
                                                    Pending
                                                @elseif($value == 4)
                                                    Closed
                                                @endif 
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @if($errors->has('status'))
                                            {{ $errors->first('status') }}
                                        @else
                                            status is required.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th></th>
                                <th><button type="submit" class="btn btn-primary">Update</button></th>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
