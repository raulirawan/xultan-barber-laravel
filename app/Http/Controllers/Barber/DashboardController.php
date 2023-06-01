<?php

namespace App\Http\Controllers\Barber;

use App\User;
use App\Booking;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardController extends Controller
{
    public function index()
    {
        // $today = Carbon::now();
        // $booking = Booking::all();

        // $bookingPending = Booking::where('status','PENDING')->count();
        // $bookingCancelled = Booking::where('status','CANCELLED')->count(); 
        // $bookingCompleted = Booking::where('status','COMPLETE')->count(); 
        // $user = User::where('roles', 'user')->count();
        $barberDeny = Booking::where('barber','Deny')
                        ->where('status','PENDING')
                        ->whereRaw('DATE(created_at) = CURRENT_DATE')->
                        count();
        $barberZacky = Booking::where('barber','Zacky')
                        ->where('status','PENDING')
                        ->whereRaw('DATE(created_at) = CURRENT_DATE')
                        ->count();

        $work = Booking::where('barber',Auth::user()->name)
                        ->where('status','PENDING')
                        ->whereRaw('DATE(created_at) = CURRENT_DATE')
                        ->count();
   
        // // dd($today);
        
        return view('pages.barber.dashboard', compact('work'));
    }


    public function work()
    {
        
        $barber = Auth::user();

        $work = [
            'isActive'   => 1,
        ]; 

        $result = $barber->update($work);

        if($result) {
            Alert::success('Success', 'You Now Work');
        }

        return redirect()->route('barber.dashboard');
    }

    public function finishWork()
    {
          $barber = Auth::user();

        $work = [
            'isActive'   => 0,
        ]; 

        $result = $barber->update($work);

        if($result) {
            Alert::success('Success', 'You Complete Work');
        }

        return redirect()->route('barber.dashboard');
    }
}
