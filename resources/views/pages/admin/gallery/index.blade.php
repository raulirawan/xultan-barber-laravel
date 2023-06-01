@extends('layouts.admin')

@section('title','Pages Gallery')
    
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
                            <h3 class="panel-title">Gallery Table</h3>
                            <a href="{{ route('gallery.create') }}" class="btn btn-success box-title">(+) Add Gallery</a>
                        </div>
                        <div class="panel-body">
                            <table class="table" id="crudTable">
                                <thead>
                                    <tr> 
                                        <th>Photo</th>
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
                { data: 'photos' , name:  'photos' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%',
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