<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BarberController extends Controller
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
            $query  = User::where('roles','BARBER');

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('barber.edit', $item->id) .' " class="btn-sm btn-primary"><i class="fa fa-pencil"></i></a>

                      
                        </div>
                    
                    ';
                    

                })
                ->editColumn('isActive', function($item)   {
                   if($item->isActive == 1){
                        return '<span class="badge badge-success">Bekerja</span>';
                   }
                    else {
                        return '<span class="badge badge-danger">Tidak Bekerja</span>';
                   }
                })
                ->rawColumns(['action','isActive'])
                ->make();
                
        }
        return view('pages.admin.barber.index');
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
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['booking_status'] = 0;

        $result = User::create($data);

        if($result) {
            Alert::success('Success', 'Your Data Has Been Save');
        }

        return redirect()->route('user.index');
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
        $item = User::findOrFail($id);

        return view('pages.admin.barber.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
       
         $data = $request->all();
        
        $item = User::findOrFail($id);

        $result = $item->update($data);
        
        if($result) {
            Alert::success('Success', 'Your Data Edit Been Save');
        }

        return redirect()->route('barber.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
    }
}
