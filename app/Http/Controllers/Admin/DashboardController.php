<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Booking;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $booking = Booking::all();

        $bookingPending = Booking::where('status','PENDING')->count();
        $bookingCancelled = Booking::where('status','CANCELLED')->count(); 
        $bookingCompleted = Booking::where('status','COMPLETE')->count(); 
        $user = User::where('roles', 'user')->count();
        $barberDeny = Booking::where('barber','Deny')
                        ->where('status','PENDING')
                        ->whereRaw('DATE(created_at) = CURRENT_DATE')->
                        count();
        $barberZacky = Booking::where('barber','Zacky')
                        ->where('status','PENDING')
                        ->whereRaw('DATE(created_at) = CURRENT_DATE')
                        ->count();

        
   
        // dd($today);
        
        return view('pages.admin.dashboard', compact('user','bookingPending','bookingCancelled','bookingCompleted','barberDeny','barberZacky'));
    }
}
