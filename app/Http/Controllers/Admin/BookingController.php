<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Http\Controllers\Controller;
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
                    $query = Booking::with(['user'])
                                    ->whereDate('created_at','=',$request->from_date)->get();
                }
                else{
                    $query = Booking::with(['user'])
                                    ->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
            }
            else 
            {
                $query  = Booking::with(['user']);
            }   
            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('booking.edit', $item->id) .' " class="btn-sm btn-primary"><i class="fa fa-pencil"></i></a>

                        <form action="' . route('booking.destroy', $item->id) .'" method="POST" style="display:inline;">
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
                ->rawColumns(['action', 'status'])
                ->make();
        }
        return view('pages.admin.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $users = User::where('booking_status', 0)
                        ->where('roles','USER')
                        ->get();

        return view('pages.admin.booking.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        // $booking = Booking::with(['user'])->where('users_id',$request->id);

        $bookingCount = Booking::all()->count();
        $data = $request->all();

        $data['code_booking'] = 'XB-' . mt_rand(00000,99999);
        $data['status'] = "PENDING";

        if($bookingCount % 2 == 0){
            $data['barber'] = "Deny";
        }
        else {
            $data['barber'] = "Zacky";
        }

        $user = User::findOrFail($request->users_id);
        
        $booking_status = [
            'booking_status' => 1,
        ];

        $user->update($booking_status);
        
        $result = Booking::create($data);
        
        if($result) {
            Alert::success('Success', 'Your Data Has Been Save');
        }

        return redirect()->route('booking.index');
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

        
        $item = Booking::findOrFail($id);
        $users = User::all();


        return view('pages.admin.booking.edit', compact('item','users'));
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
    
        $data = $request->all();

        $item = Booking::with(['user'])->findOrFail($id);
        
        if($request->status == "CANCELLED" || $request->status == "COMPLETE"){
            if($item->users_id == $item->user->id){
               $user =  User::find($item->user->id);

                $booking_status = [
                    'booking_status' => 0,
                ];

                $user->update($booking_status);
            }
        }
        // dd($item);
        $data['code_booking'] = $item->code_booking;

        $result = $item->update($data);
        
        if($result) {
            Alert::success('Success', 'Your Data Edit Been Save');
        }

        return redirect()->route('booking.index');
    }

    /**
     * Remove the specified resource from storage.
     *eb
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   

        $item = Booking::findOrFail($id);

        if($item->status == "PENDING"){
             $user = User::findOrFail($item->users_id);

            $booking_status = [
                'booking_status' => 0,
            ];

            $user->update($booking_status);

        }

        $item->delete();
        
        return redirect()->route('booking.index');
    }
}
