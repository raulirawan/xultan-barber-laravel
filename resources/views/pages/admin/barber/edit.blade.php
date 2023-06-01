@extends('layouts.admin')

@section('title','Edit Barber')
    
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
                            <h3 class="panel-title">Form Edit Barber</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('barber.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-12">Bekerja</label>
                                <div class="col-sm-12">
                                    <select name="isActive" class="form-control">
                                        <option value="1">Bekerja</option>
                                        <option value="0">Tidak Bekerja</option>
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
