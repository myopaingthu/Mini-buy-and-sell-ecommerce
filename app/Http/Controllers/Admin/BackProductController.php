<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\StoreProductRequest;

class BackProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Give a resource data for ajax call
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxData()
    {
        $products = Product::all();
        return Datatables::of($products)->editColumn('created_at', function ($request) {
            return $request->created_at->format('Y-m-d'); // human readable format
        })
            ->addColumn('category', function ($product) {
                return $product->category->name;
            })
            ->addColumn('user', function ($product) {
                return $product->user->name;
            })
            ->addColumn('action', function ($product) {
                $icon = '<a href="' . route('backend-products.show', [$product->id]) . '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i>View</a>
                                                <a href="' . route('backend-products.edit', [$product->id]) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger delete-button" data-id="' . $product->id . '"><i class="fas fa-trash"></i>Delete</button>';
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
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->input('name'),
            'user_id' => Auth::id(),
            'category_id' => $request->input('category'),
            'price' => $request->input('price'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
        ]);

        foreach ($request->file('images') as $key => $value) {
            $image = time() . $key . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('images'), $image);
            $product_image = new Image(['name' => $image]);
            $product->images()->save($product_image);
        }

        return redirect()->route('backend-products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $id)
    {
        Product::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category'),
                'price' => $request->input('price'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'description' => $request->input('description'),
                'available' => $request->input('available'),
            ]);

        if ($request->file('images')) {
            $product = Product::findOrFail($id);
            $product_images = $product->images;
            foreach ($product_images as $product_image) {
                $product_image->delete();
            }

            foreach ($request->file('images') as $key => $value) {
                $image = time() . $key . '.' . $value->getClientOriginalExtension();
                $value->move(public_path('images'), $image);
                $product_image = new Image(['name' => $image]);
                $product->images()->save($product_image);
            }
        }

        return redirect()->route('backend-products.index')
            ->with('success', 'Product edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return 'success';
    }

    /**
     * Generate excel file of resource
     * 
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
    * Import from an excel file
    * @param \Illuminate\Http\Request $request 
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        
        Excel::import(new ProductsImport, request()->file('file'));
             
        return redirect()->route('backend-products.index')
            ->with('success', 'Products imported successfully.');
    }
}
