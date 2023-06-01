@extends('layouts.admin')

@section('title','Create Gallery')
    
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
                            <h3 class="panel-title">Form Create Gallery</h3>
                        </div>
                        <div class="panel-body">
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Photo</label>
                                <div class="col-md-12">
                                    <input type="file"  name="photos" class="form-control form-control-line"> </div>
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

