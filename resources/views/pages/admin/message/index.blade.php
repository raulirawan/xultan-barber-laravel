@extends('layouts.admin')

@section('title','Pages Message')
    
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
                    <!-- BASIC TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Message Table</h3>
                            {{-- <a href="{{ route('message.create') }}" class="btn btn-success box-title">(+) Add Message</a> --}}
                        </div>
                        <div class="panel-body">
                            <table class="table" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
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

         var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax:{
                url: '{!! url()->current() !!}',
            },

            columns: [
                { data: 'name' , name:  'name' },
                { data: 'email' , name:  'email' },
                { data: 'subject' , name:  'subject' },
                { data: 'message' , name:  'message' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '20%',
                }
            ]
        });
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
        })
    });
    </script>

   

@endpush