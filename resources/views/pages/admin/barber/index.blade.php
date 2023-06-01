@extends('layouts.admin')

@section('title','Pages Barber')
    
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
                            <h3 class="panel-title">Barber Table</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
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
                { data: 'roles' , name:  'roles' },
                { data: 'isActive' , name:  'isActive' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%',
                }
            ]
        });
         
      
    });
    </script>

   

@endpush