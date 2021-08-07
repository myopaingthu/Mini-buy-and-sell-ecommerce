<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackendCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

         /**
     * Give a resource data for ajax call
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxData()
    {
        return Datatables::of(Category::query())->editColumn('created_at', function ($request) {
                                        return $request->created_at->format('Y-m-d'); // human readable format
                                    })
                                    ->addColumn('action', function ($user) {
                                        $icon = '<button type="submit" class="btn btn-sm btn-danger delete-button" data-id="'.$user->id.'"><i class="fas fa-trash"></i> Delete</button>';
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
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,',
        ]);

        Category::create($request->all());

        return redirect()->route('backend-categories.index')
                        ->with('success','Category created successfully.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return 'success';
    }
}
