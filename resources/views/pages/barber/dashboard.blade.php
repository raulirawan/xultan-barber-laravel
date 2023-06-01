@extends('layouts.barber')

@section('title','Dashboard')
    

@section('content')

<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Weekly Overview</h3>
            <p class="panel-subtitle">{{ Carbon\Carbon::now()->format('d M Y H:i') }}</p>
            
            <div class="row">
                <div class="col-md-3">
                      <div>Status Bekerja</div>
                      @if(Auth::user()->isActive == 1)
                        <div class="badge-success">Sedang Bekerja</div>
                      @else
                         <div class="badge-warning">Tersedia</div>
                      @endif
                </div>
            </div>
            
        </div>
        <div class="panel-body">
            <div class="row">
                
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-warning"></i></span>
                        <p>
                            <span class="number">{{ $work }}</span>
                            <span class="title">Work</span>
                        </p>

                      

                        
                    </div>
                    <form action="{{ route('barber.work') }}" method="POST" class="mt-5">
                            @csrf
                            <button type="submit" class="btn btn-info mr-3">Bekerja</button>
                    </form>
                    <br>
                     <form action="{{ route('barber.finish.work') }}" method="POST" class="mt-5">
                            @csrf
                            <button type="submit" class="btn btn-danger mr-3">Selesai Bekerja</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- END OVERVIEW -->
</div>

@endsection