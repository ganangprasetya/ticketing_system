@extends('layouts.app')

@section('content')
    <div class="container">
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
                        <a href="{{ route('tickets.manage') }}?filter=status&keyword=&status=1" style="color:#4CAF50;">View Details <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="{{ route('tickets.manage') }}?filter=status&keyword=&status=2" style="color:#9db69f;">View Details <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="{{ route('tickets.manage') }}?filter=status&keyword=&status=3" style="color:#ffcd32;">View Details <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="{{ route('tickets.manage') }}?filter=status&keyword=&status=4" style="color:#ff0000;">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
        </div>
    </div>
@endsection