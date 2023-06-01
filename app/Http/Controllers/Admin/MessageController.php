<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query  = Message::query()->latest();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">

                        <a href=" '. route('message.show', $item->id) .' " class="btn-sm btn-info"><i class="fa fa-eye"></i></a>
                       

                        <form action="' . route('message.destroy', $item->id) .'" method="POST" style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. $item->id .'"><i class="fa fa-trash"></i></button>

                        </form> 
                        </div>
                    
                    ';
                    

                })
                
                ->rawColumns(['action'])
                ->editColumn('message', function ($item){
                    return Str::limit($item->message, 10);
                })
                ->make();
                
        }
        return view('pages.admin.message.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.admin.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $data = $request->all();

      
        $result = Message::create($data);

        if($result) {
            Alert::success('Success', 'Your Data Has Been Save');
        }

        return redirect()->route('message.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Message::findOrFail($id);

        return view('pages.admin.message.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Message::findOrFail($id);

        return view('pages.admin.message.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MessageRequest $request, $id)
    {   
       
        $data = $request->all();
        

        $item = Message::findOrFail($id);

        $result = $item->update($data);
        
        if($result) {
            Alert::success('Success', 'Your Data Edit Been Save');
        }

        return redirect()->route('message.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Message::findOrFail($id);
        $item->delete();
        
        return redirect()->route('message.index');
    }
}
