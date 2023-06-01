<?php

namespace App\Http\Controllers;

use App\User;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $bookingPending = Booking::with(['user'])
                                ->where('users_id', Auth::user()->id)
                                ->where('status','PENDING')
                                ->count();

        $bookingCancelled = Booking::with(['user'])
                                ->where('users_id', Auth::user()->id)
                                ->where('status','CANCELLED')
                                ->count();
        
        $bookingCompleted = Booking::with(['user'])
                                ->where('users_id', Auth::user()->id)
                                ->where('status','COMPLETE')
                                ->count();
        
        return view('pages.user.dashboard', compact('bookingPending','bookingCancelled','bookingCompleted'));
    }

    public function booking()
    {
        
        // $item = Booking::where('users_id', Auth::user()->id)->firstOrFail();
        if(request()->ajax())
        {
            $query  = Booking::with(['user'])
                                ->where('users_id',Auth::user()->id)
                                ->get();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">

                        <form action="' . route('dashboard-booking-cancel', $item->id) .'" method="POST" style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. $item->id .'"><i class="fa fa-trash"></i></button>

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
                ->rawColumns(['action','status'])
                ->make();
                
        }

        // // $uses = User::with(['booking'])->get();
        // $uses = Booking::with(['user'])->get();
        // dd($uses);
        return view('pages.user.booking.index');
        // 
    }

    public function store(BookingRequest $request)
    {

        $bookingCount = Booking::all()->count();
        
        if($bookingCount % 2 == 0){
          $barber = "Deny";
        }
        else {
            $barber = "Zacky";
        }
        $booking = [
           'users_id'      => Auth::user()->id,
           'code_booking'  => 'XB-' . mt_rand(00000,99999),
           'date_time'     => $request->date_time,
           'status'        => "PENDING",
           'barber'        => $barber,
        ];

        $booking_status = [
            'booking_status' => 1,
        ];

        //deklarasi user login
        $user = Auth::user();

        //create booking
         $result =  Booking::create($booking);
         if($result) {
            Alert::success('Success', 'Your Data Has Been Save');
        }
      
        //update status booking menjadi 1
        $user->update($booking_status);
        
        return redirect()->route('dashboard-booking');
    }

    public function cancelBooking($id)
    {
        
        $item = Booking::findOrFail($id);
        $user = Auth::user();

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

        return redirect()->route('dashboard-booking');

        // $item = Booking::findOrFail($id);
        // $item->delete();
        
        // return redirect()->route('dashboard-booking');
    }
}
