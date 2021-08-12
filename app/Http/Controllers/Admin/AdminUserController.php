<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-users.index');
    }

    /**
     * Give a resource data for ajax call
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxData()
    {
        $users = User::where('role_id', 2)->get();
        return Datatables::of($users)->editColumn('created_at', function ($request) {
            return $request->created_at->format('Y-m-d'); // human readable format
        })
            ->addColumn('products', function ($user) {
                return $user->products->count();
            })
            ->addColumn('action', function ($user) {
                $icon = '<a href="' . route('adminusers.edit', [$user->id]) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <button type="submit" class="btn btn-sm btn-danger delete-button" data-id="' . $user->id . '"><i class="fas fa-trash"></i> Delete</button>';
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
        return view('admin.admin-users.create');
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
            'role_id' => 2,
        ]);

        return redirect()->route('adminusers.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('admin.admin-users.edit', compact('user'));
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
        return view('admin.admin-users.edit', compact('user'));
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

        return redirect()->route('adminusers.index')
            ->with('success', 'User edited successfully.');
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
