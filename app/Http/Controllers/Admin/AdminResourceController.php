<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;

class AdminResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins.index');
    }

     /**
     * Give a resource data for ajax call
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxData()
    {
        $users = User::where('role_id', 1)->get();
        return Datatables::of($users)->editColumn('created_at', function ($request) {
                                        return $request->created_at->format('Y-m-d'); // human readable format
                                    })
                                    ->addColumn('action', function ($user) {
                                        $icon = '<a href="'.route('admins.edit', [$user->id]).'" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <button type="submit" class="btn btn-sm btn-danger delete-button" data-id="'.$user->id.'"><i class="fas fa-trash"></i> Delete</button>';
                                        return $icon;
                                    })
                                    ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('name')),
            'role_id' => 1
        ]);

        return redirect()->route('admins.index')
                        ->with('success','Admin created successfully.');
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
        $user = User::findOrFail($id);
        return view('admin.admins.edit', compact('user'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed|max:20',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password') ? Hash::make($request->input('password')) : $user->password;
        $user->update();

        return redirect()->route('admins.index')
                        ->with('success','Admin edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return 'success';
    }
}
