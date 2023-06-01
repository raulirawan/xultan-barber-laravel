@extends('layouts.admin')

@section('title','Pages Booking')
    
@section('content')


<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Booking Now</h3>
        </div>
        <div class="panel-body">
            <div style="max-width: 60%; margin-bottom: 20px; margin-right: 20px;">
                <form method="GET" class="form-inline">
                    <div class="form-group mb-2">
                        <input type="date" class="form-control" name="date" required>
                    </div>

                    <div class="form-group mb-2">
                        <div class="form-group">
                                <select name = "barber" class="form-control" required>
                                    <option  value="">--Pilih Barber--</option>
                                    <option value="JOHN">JOHN</option>
                                    <option value="ROGER">ROGER</option>
                                   
                                </select>   
                        </div>
                    </div>
            
                    <button type="submit" class="btn btn-primary mb-2" name="date_search">Search!</button>
                </form>
            </div>
            <div class="row">
                
                {{-- <div class="col-md-12"> --}}
                    @php
                        if(isset($_GET['date_search'])) {
                            for ($x=10; $x<=19; $x++) {
                        $available = true;
                        foreach ($booking as $item) {
                            if($item->start <= $x && $x < $item->end && $item->status != 'CANCELLED') {
                                $available = false;
                            }
                        }
          
                        if ($available) {
                            echo '<div class="col-md-2">
                                <div class="metric">
                                    <p style="text-align: center;">
                                    ' . $x . '.00 - ' . ($x + 1) . '.00
                                    </p>
                                </div>
                            </div>';
                        }
                        else {
                        echo '<div class="col-md-2">
                            <div class="metric bg-danger">
                                <p style="text-align: center; color: white;">
                                ' . $x . '.00 - ' . ($x + 1) . '.00
                                </p>
                            </div>
                        </div>';
                    
                    }    
                }
            }
            
            @endphp


              
                    <!-- BASIC TABLE -->
                    {{-- <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Booking Table</h3> --}}
                             {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                Booking Now
                            </button> --}}
                           {{-- @can('create', App\Booking::class)
                            <a href="#" class="btn btn-success box-title" data-toggle="modal" data-target="#exampleModal">(+) Add Booking</a>                    
                           @endcan --}}
                            {{-- @endif --}}
                            
                           
{{--                 
                        
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>Code Booking</th>
                                        <th>Name</th>
                                        <th>Date and Time Booking</th>
                                        <th>Created At</th>
                                        <th>Barber</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div> --}}
                    <!-- END BASIC TABLE -->
                {{-- </div> --}}
            
            </div>
        </div>    
    </div>
    <!-- END OVERVIEW -->    
</div>



<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Booking Xultan Barbershop</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <form action="{{ route('dashboard-booking-store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
            @csrf
            <input type="hidden" name="users_id">
            <div class="form-group">
                <label for="example-email" class="col-md-12">Date & Time</label>
                <div class="col-md-12">
                    <input type="text" id="date_time" name="date_time" class="form-control form-control-line" readonly autocomplete="off"> </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div> --}}
    
@endsection
