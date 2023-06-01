@extends('layouts.admin')

@section('title','Create Message')
    
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
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- INPUTS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Form Create User</h3>
                        </div>
                        <div class="panel-body">
                         <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="Enter Email" value="{{ old('email') }}" class="form-control form-control-line" name="email"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Subject</label>
                                <div class="col-md-12">
                                    <input type="subject" placeholder="Enter Subject" value="{{ old('subject') }}" name="subject" class="form-control form-control-line"> </div>
                                </div>
                            <div class="form-group">
                                <label class="col-sm-12">Message</label>
                                <div class="col-sm-12">
                                <input type="textarea" placeholder="Enter Text" value="{{ old('message') }}" name="message" class="form-control form-control-line" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Save Now</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- END INPUTS -->
                   
                </div>
            
            </div>
        </div>    
    </div>
    <!-- END OVERVIEW -->    
</div>

{{-- <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pages Message</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Create Message</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <div class="white-box">
                <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12">Full Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="email" placeholder="Enter Email" value="{{ old('email') }}" class="form-control form-control-line" name="email"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Subject</label>
                        <div class="col-md-12">
                            <input type="subject" placeholder="Enter Subject" value="{{ old('subject') }}" name="subject" class="form-control form-control-line"> </div>
                        </div>
                    <div class="form-group">
                        <label class="col-sm-12">Message</label>
                        <div class="col-sm-12">
                           <input type="textarea" placeholder="Enter Text" value="{{ old('message') }}" name="message" class="form-control form-control-line" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">Save Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
</div> --}}
    
@endsection

@push('down-script')
    <script>
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
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%',
                }
            ]
        })
    </script>
@endpush