<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
            $query  = User::query()->latest();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('user.edit', $item->id) .' " class="btn-sm btn-primary"><i class="fa fa-pencil"></i></a>

                        <form action="' . route('user.destroy', $item->id) .'" method="POST" style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. $item->id .'"><i class="fa fa-trash"></i></button>

                        </form> 
                        </div>
                    
                    ';
                    

                })
                ->rawColumns(['action'])
                ->make();
                
        }
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.admin.user.create');
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

        return view('pages.admin.user.edit', compact('item'));
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
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'unique:users,email,' .$id,
            'roles' => 'nullable|string|in:ADMIN,USER',
        ]);
    
        $data = $request->all();
        

        $item = User::findOrFail($id);

        $result = $item->update($data);
        
        if($result) {
            Alert::success('Success', 'Your Data Edit Been Save');
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->booking()->delete();
        $item->delete();
        
        return redirect()->route('user.index');
    }
}
