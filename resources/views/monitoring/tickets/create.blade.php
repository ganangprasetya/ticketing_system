@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Monitoring</a></li>
                        <li class="breadcrumb-item"><a href="#">Ticket Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Ticket</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('tickets.store') }}" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-left">Add Ticket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="w-25"><label for="company" class="col-form-label">Company *</label></td>
                                <td>
                                    <select class="selectize {{ ($errors->has('database')) ? ' is-invalid':'' }}" name="company" required>
                                        <option value="">Select Company..</option>
                                        @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{ $company->name }} {{ $company->note }}</option>
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
                                    <textarea name="pic_complaint" class="col-6 form-control{{ ($errors->has('pic_complaint')) ? ' is-invalid':'' }}" id="pic_complaint" placeholder="PIC Complaint">{{ old('pic_complaint') }}</textarea>
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
                                            <input type="text" name="date_complaint" class="col-5 form-control datetimepicker bg-white{{ ($errors->has('date_complaint')) ? ' is-invalid':'' }}" value="{{ old('date_complaint') }}" required data-input/>
                                            <span class="input-group-append">
                                                <span class="input-group-text input-button" title="toggle" data-toggle><i class="fa fa-calendar"></i></span>
                                                <span class="input-group-text input-button" title="clear" data-clear><i class="fa fa-remove"></i></span>
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
                                    <textarea name="note" class="col-6 form-control{{ ($errors->has('note')) ? ' is-invalid':'' }}" id="note" placeholder="Note Complaint">{{ old('note') }}</textarea>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th></th>
                                <th><button type="submit" class="btn btn-primary">Add</button></th>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
