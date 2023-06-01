@extends('layouts.admin')

@section('title','Detail Message')
    
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
                            <a href="{{ route('user.create') }}" class="btn btn-success box-title">(+) Add Message</a>
                        </div>
                        <div class="panel-body">
                              <div class="table-responsive">
                                <table class="table">
                                    <tbody>

                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $item->name }}</td>  
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $item->email }}</td>  
                                        </tr>

                                        <tr>
                                            <th>Subject</th>
                                            <td>{{ $item->subject }}</td>  
                                        </tr>

                                        <tr>
                                            <th>Message</th>
                                            <td>{{ $item->message }}</td>  
                                        </tr>
                                                                    
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('message.index') }}" class="btn btn-primary">Back Message</a>
                        </div>
                    </div>
                    <!-- END BASIC TABLE -->
                </div>
            
            </div>
        </div>    
    </div>
    <!-- END OVERVIEW -->    
</div>
{{-- <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pages Message Detail</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Detail Message</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Detail Message</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>

                                <tr>
                                    <th>Name</th>
                                    <td>{{ $item->name }}</td>  
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{ $item->email }}</td>  
                                </tr>

                                <tr>
                                    <th>Subject</th>
                                    <td>{{ $item->subject }}</td>  
                                </tr>

                                <tr>
                                    <th>Message</th>
                                    <td>{{ $item->message }}</td>  
                                </tr>
                                                              
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('message.index') }}" class="btn btn-primary">Back Message</a>
                </div>
            </div>
        </div>
        <!-- /.row -->

   
</div> --}}
    
@endsection
