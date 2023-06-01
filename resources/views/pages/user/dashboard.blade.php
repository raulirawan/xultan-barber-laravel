@extends('layouts.dashboard-user')

@section('title','Dashboard')
    

@section('content')

<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Weekly Overview</h3>
            <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-database"></i></span>
                        <p>
                            <span class="number">{{ $bookingPending }}</span>
                            <span class="title">Status Pending</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-times"></i></span>
                        <p>
                            <span class="number">{{ $bookingCancelled }}</span>
                            <span class="title">Status Cancelled</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <p>
                            <span class="number">{{ $bookingCompleted }}</span>
                            <span class="title">Status Completed</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OVERVIEW -->
</div>

@endsection