@extends('layouts.admin')

@section('title','Edit Booking')
    
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
                            <h3 class="panel-title">Form Edit Booking</h3>
                        </div>
                        <div class="panel-body">
                         <form action="{{ route('booking.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-12">Nama</label>
                                <div class="col-sm-12">
                                    <select name="users_id" class="form-control form-control-line">
                                        <option value="{{ $item->user->id }}" selected>{{ $item->user->name }}</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Date & Time</label>
                                <div class="col-md-12">
                                    <input type="text" id="date_time" name="date_time" value="{{ $item->date_time }}" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Status</label>
                                <div class="col-sm-12">
                                    <select name="status" class="form-control form-control-line">
                                        <option value="{{ $item->status }}">Tidak Di ganti</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                        <option value="COMPLETE">COMPLETE</option>
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


{{-- <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pages Booking</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Edit Booking</li>
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
                <form action="{{ route('booking.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                    @method("PUT")
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-12">Nama</label>
                        <div class="col-sm-12">
                            <select name="users_id" class="form-control form-control-line">
                                <option value="{{ $item->user->id }}" selected>{{ $item->user->name }}</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Date & Time</label>
                        <div class="col-md-12">
                            <input type="text" id="date_time" name="date_time" value="{{ $item->date_time }}" class="form-control form-control-line"> </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-12">Status</label>
                        <div class="col-sm-12">
                            <select name="status" class="form-control form-control-line">
                                <option value="{{ $item->status }}">Tidak Di ganti</option>
                                <option value="PENDING">PENDING</option>
                                <option value="CANCELLED">CANCELLED</option>
                                <option value="COMPLETE">COMPLETE</option>
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
    </div>

   
</div> --}}
    
@endsection

@push('down-script')
    <script>
        
        $(document).ready(function(){
            jQuery.datetimepicker.setLocale('id')
            $('#date_time').datetimepicker({
                timepicker: true,
                datepicker: true,
                format: 'Y-m-d H:i',
                weeks: true,
                step:30,
                mask: true,
                minDate: true,
                minTime: true,
                lang: 'id',
                allowTimes: ['10:00','10:30','11:30','12:00','12:30',
                '13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30',
                '17:00','17:30','18:00','18:30','19:00','19:30','20:00'],
                
                i18n: {
                    month: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September',
                           'Oktober','November','Desember'],
                    
                    dayOfWeek: ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
                }
            });  

        });

       


    </script>
@endpush