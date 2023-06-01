<?php

namespace App\Http\Controllers;

use App\Message;
use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('pages.home', compact('galleries'));
    }

    public function sendMessage(MessageRequest $request)
    {
        $data = $request->all();

        $result = Message::create($data);

        if($result) {
            Alert::success('Success', 'Your Data Has Send');
        }

        return redirect()->route('home');
    }

}
