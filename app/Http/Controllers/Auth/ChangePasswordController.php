<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ChangePasswordController extends Controller
{
    

    public function index()

    {
        return view('pages.user.changePassword.index');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
        'oldPassword' => 'required',
        'password' => 'required|confirmed',
    
        ]);
        if(!(Hash::check($request->get('oldPassword'), Auth::user()->password))){
            
            alert()->error('Error', 'Your Old Password Not Match');
            return redirect()->route('change-password');
        }

        if(strcmp($request->get('oldPassword'), $request->get('password')) == 0){
            
            alert()->error('Error', 'Your New Password Not Same with Your Old Password');
            return redirect()->route('change-password');
        }

     
       
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        alert()->success('success','Your Passowrd Has Been Changed!');
        return redirect()->route('dashboard');
    }
}
