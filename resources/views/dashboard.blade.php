@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        @role('administrator')
                        <li class="breadcrumb-item"><a href="#">Administrator</a></li>
                        @endrole
                        @role('user')
                        <li class="breadcrumb-item"><a href="#">{{ Auth()->user()->fullname }}</a></li>
                        @endrole
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
                <div class="card card-position-1 text-white">
                    <div class="card-header" style="background-color:#4CAF50;">
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        <div class="card-title-position">
                            <p style="font-size:50px;">{{ $opentickets }}</p>
                            <p style="margin-top:-20px;"> Open Tickets</p>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align:right;">
                        <a href="{{ route('tickets.manage') }}" style="color:#4CAF50;">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="card card-position-1 text-white">
                    <div class="card-header" style="background-color:#9db69f;">
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        <div class="card-title-position">
                            <p style="font-size:50px;">{{ $processtickets }}</p>
                            <p style="margin-top:-20px;"> Process Tickets</p>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align:right;">
                        <a href="{{ route('tickets.manage') }}" style="color:#9db69f;">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="card card-position-1 text-white">
                    <div class="card-header" style="background-color:#ffcd32;">
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        <div class="card-title-position">
                            <p style="font-size:50px;">{{ $pendingtickets }}</p>
                            <p style="margin-top:-20px;"> Pending Tickets</p>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align:right;">
                        <a href="{{ route('tickets.manage') }}" style="color:#ffcd32;">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="card card-position-1 text-white">
                    <div class="card-header" style="background-color:#ff0000;">
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        <div class="card-title-position">
                            <p style="font-size:50px;">{{ $closetickets }}</p>
                            <p style="margin-top:-20px;"> Close Tickets</p>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align:right;">
                        <a href="{{ route('tickets.manage') }}" style="color:#ff0000;">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
        </div>
    </div>
@endsection