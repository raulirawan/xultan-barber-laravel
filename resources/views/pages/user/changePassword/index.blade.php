@extends('layouts.dashboard-user')

@section('title','Pages Change Password')
    
@section('content')


<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Weekly Overview</h3>
        </div>
         @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="panel-body">
             <form action="{{ route('change-password-update') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                @csrf
               <div class="form-group">
                    <label for="example-email" class="col-md-12">Old Password</label>
                    <div class="col-md-12">
                        <input type="password" name="oldPassword" class="form-control" autocomplete="off"> 
                    </div>
                </div>
                <div class="form-group">
                <label for="example-email" class="col-md-12">New Password</label>
                    <div class="col-md-12">
                        <input type="password" name="password" class="form-control" autocomplete="off"> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">New Password Confirmation</label>
                    <div class="col-md-12">
                        <input type="password" name="password_confirmation" class="form-control" autocomplete="off"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Save Now</button>
                    </div>
                </div>
            </form>
        </div>    
    </div>
    <!-- END OVERVIEW -->    
</div>




    
@endsection

