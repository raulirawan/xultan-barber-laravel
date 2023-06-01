@extends('layouts.admin')

@section('title','Edit User')
    
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
                            <h3 class="panel-title">Form Edit User</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Enter Name" name="name" value="{{ $item->name }}" class="form-control"> </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="Enter Email" value="{{ $item->email }}" class="form-control" name="email"> </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-sm-12">Roles</label>
                                <div class="col-sm-12">
                                    <select name="roles" class="form-control">
                                        <option value="USER">User</option>
                                        <option value="ADMIN">Admin</option>
                                    </select>
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
