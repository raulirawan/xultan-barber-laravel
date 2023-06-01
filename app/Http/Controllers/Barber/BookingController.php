<?php

namespace App\Http\Controllers\Barber;

use App\User;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(request()->ajax())
        {

            if(!empty($request->from_date)){
                 
                if($request->from_date === $request->to_date){
                    $query = Booking::with(['user'])->where('barber',Auth::user()->name)
                                    ->whereDate('created_at','=',$request->from_date)->get();
                }
                else{
                    $query = Booking::with(['user'])->where('barber',Auth::user()->name)
                                    ->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
            }
            else 
            {
                $query  = Booking::with(['user'])->where('barber',Auth::user()->name);
            }   
            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                       

                        <form action="' . route('barber.cancel', $item->id) .'" method="POST" 
                        style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. 
                        $item->id .'"><i class="fa fa-trash"></i></button>

                        </form> 
                        </div>
                    
                    ';
                })
                ->editColumn('date_time', function($item){
                    return ($item->date_time->format('d M Y H:i'));
                })
                 ->editColumn('created_at', function($item){
                    return ($item->created_at->format('d M Y H:i'));
                })
                
                ->editColumn('status', function($item)   {
                   if($item->status == "PENDING"){
                        return '<span class="badge badge-warning">'. $item->status .'</span>';
                   }
                   else if($item->status == "CANCELLED"){
                        return '<span class="badge badge-danger">'. $item->status .'</span>';
                   }
                    else if($item->status == "COMPLETE"){
                        return '<span class="badge badge-success">'. $item->status .'</span>';
                   }
                })
                ->rawColumns(['action', 'status'])
                ->make();
        }
        return view('pages.barber.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
      
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingRequest $request, $id)
    {   
    
        
    }

    /**
     * Remove the specified resource from storage.
     *eb
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelBooking($id)
    {   

        $item = Booking::findOrFail($id);
        $user = User::findOrFail($item->users_id);

        $booking_complete = [
            'status'   => "COMPLETE",
        ]; 

        $booking_cancel = [
            'status'   => "CANCELLED",
        ]; 

        $booking_status = [
            'booking_status' => 0,
        ];



        if($item->status == "COMPLETE"){
            $item->update($booking_complete);

        }
        else {
            $item->update($booking_cancel);
            $user->update($booking_status);
        }

        return redirect()->route('barber.booking');
    }
}
