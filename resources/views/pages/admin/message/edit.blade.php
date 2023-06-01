@extends('layouts.admin')

@section('title','Edit Message')
    
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
                            <h3 class="panel-title">Form Edit Message</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('message.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                                @method("PUT")
                                @csrf
                            <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Enter Name" name="name" value="{{ $item->name }}" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="Enter Email" value="{{ $item->email }}" class="form-control form-control-line" name="email"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Subject</label>
                                    <div class="col-md-12">
                                        <input type="subject" placeholder="Enter Subject" value="{{ $item->subject }}" name="subject" class="form-control form-control-line"> </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Message</label>
                                    <div class="col-sm-12">
                                    <input type="textarea" placeholder="Enter Text" value="{{ $item->message }}" name="message" class="form-control form-control-line" >
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

    
@endsection
