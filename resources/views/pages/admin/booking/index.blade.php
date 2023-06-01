@extends('layouts.admin')

@section('title','Pages Booking')
    
@section('content')

<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Weekly Overview</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                                readonly />
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                                readonly />
                        </div>
                        <div class="col-md-4">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                        </div>

                    </div>
                    <!-- BASIC TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Booking Table</h3>
                          
                            <a href="{{ route('booking.create') }}" class="btn btn-success box-title">(+) Add Booking</a>
                   
                        </div>
                        <div class="panel-body">
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
                    <!-- END BASIC TABLE -->
                </div>
            
            </div>
        </div>    
    </div>
    <!-- END OVERVIEW -->    
</div>
    
@endsection

@push('down-script')
    <script>
         
       $(document).ready(function() {

         $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $(document).on('click', '.btnDelete', function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{!! url()->current() !!}' + '/' + id,
                        type: "POST",
                        data: {"_method" : "DELETE"}
                    }).done(function() {
                        swal("Your data has been delete", {
                            icon: "success"
                        });
                        $('.table').DataTable().ajax.reload();
                    });
                } else {
                    swal("Your data is safe!");
                }
            });
        });

        load_data();

        $('#from_date').datetimepicker({
             datepicker: true,
             timepicker: false,
             format: 'Y-m-d',
             weeks: true,
        }); 

        $('#to_date').datetimepicker({
             datepicker: true,
             timepicker: false,
             format: 'Y-m-d',
             weeks: true,
        }); 


        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if(from_date != '' && to_date != '')
            {
                $('#crudTable').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                alert('Both Data is Required')
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#crudTable').DataTable().destroy();
            load_data();
        });

        function load_data(from_date = '', to_date = '')
        {
            $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{!! url()->current() !!}',
                    type: 'GET',
                    data: {from_date:from_date, to_date:to_date}
                },
                columns: [
                    { data: 'code_booking' , name:  'code_booking' },
                    { data: 'user.name' , name:  'user.name' },
                    { data: 'date_time' , name: 'date_time' },
                    { data: 'created_at' , name: 'created_at' },
                    { data: 'barber' , name: 'barber' },
                    { data: 'status' , name:  'status' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searcable: false,
                        width: '15%',
                    }
                ]

            });
        }   
    });
    </script>

   

@endpush