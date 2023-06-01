@extends('layouts.admin')

@section('title','Dashboard')
    

@section('content')

<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Weekly Overview</h3>
            <p class="panel-subtitle">{{ Carbon\Carbon::now()->format('d M Y H:i') }}</p>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ $user }}</span>
                            <span class="title">User Count</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-database"></i></span>
                        <p>
                            <span class="number">{{ $bookingPending }}</span>
                            <span class="title">Status Pending</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-times"></i></span>
                        <p>
                            <span class="number">{{ $bookingCancelled }}</span>
                            <span class="title">Status Cancelled</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-check"></i></span>
                        <p>
                            <span class="number">{{ $bookingCompleted }}</span>
                            <span class="title">Status Complete</span>
                        </p>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ $barberDeny }}</span>
                            <span class="title">Barber Deny</span>
                        </p>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ $barberZacky }}</span>
                            <span class="title">Barber Zacky</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OVERVIEW -->
</div>

@endsection