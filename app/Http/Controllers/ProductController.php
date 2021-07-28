<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\EditProductRequest;
use Auth;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(12);
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 12);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function userProduct(User $user)
    {
        $products = $user->products()->paginate(12);
        return view('products.userProduct', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 12);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); 
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmCreate(StoreProductRequest $request)
    {
        $product=$request->only([
            'name',
            'price',
            'phone',
            'address',
            'description'
         ]);

         $category = Category::where('id',$request->input('category'))->first();

            foreach ($request->file('images')  as $key => $value) {
                $image = time() . $key . '.' . $value->getClientOriginalExtension();
                $value->move(public_path('images'), $image);
                $images[] = $image;
            }

        return view('products.confirmCreate', compact('product','category','images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        foreach ($request->input('images') as $value){
            $image = new Image(['name' => $value]);
            $product->images()->save($image);
        }
        return redirect()->route('products.index')
                        ->with('success','Product uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $favourited_products = auth()->user()->favourites;
        if ($favourited_products->isNotEmpty()) {
            foreach ($favourited_products as $key => $value) {
                if ($value->product_id == $product->id) {
                    $favourited = $value->id;
                    break;
                }
                else {
                    $favourited = 0;
                }
            }
        }
        else {
            $favourited = 0;
        } 
        return view('products.show', compact('product', 'favourited'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function confirmEdit(EditProductRequest $request, Product $product)
    {
        $edited_product=$request->only([
            'name',
            'price',
            'phone',
            'address',
            'description'
         ]);

         $category = Category::where('id', $request->input('category'))->first();

         if ($request->file('images')){
            foreach ($request->file('images')  as $key => $value) {
                $image = time() . $key . '.' . $value->getClientOriginalExtension();
                $value->move(public_path('images'), $image);
                $images[] = $image;
            }
         }
         else {
            foreach ($product->images as $key => $value) {
                $images[] = $value->name;
            }
         }

         $id = $product->id;

         return view('products.confirmEdit', compact('edited_product','category','images', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        DB::table('products')
        ->where('id', $product->id)
        ->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category'),
            'price' => $request->input('price'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
        ]);

        $product_images = $product->images;
        foreach ($product_images as $product_image) {
            $product_image->delete();
        }

        foreach ($request->input('images') as $value){
            $image = new Image(['name' => $value]);
            $product->images()->save($image);
        }

        // foreach ($product_images as $product_image) {
        //     foreach ($request->input('images') as $value) {
        //         if ($value == $product_image->name) {
        //             break;
        //         }
        //         else {
        //             $image = new Image(['name' => $value]);
        //             $product->images()->save($image);
        //             $product_image->delete();
        //         }
        //     }   
        // }

        return redirect()->route('products.index')
                        ->with('success','Product edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully.');
    }

    /**
     * Search for the specified keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3',
        ]);
        $query = $request->input('search');
        $products = Product::where('name', 'like', "%$query%")
                           ->orWhere('description', 'like', "%$query%")
                           ->get();
        return view('products.searchedProducts', compact('products'));
    }

    /**
     * Sort by the specified keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortProduct(Request $request)
    {
        $type = $request->input('type');
        $sort = $request->input('sort');

        if ($type == 'date' && $sort == 'ascend') {
            $products = Product::orderBy('created_at', 'asc')->paginate(12);
        }
        elseif ($type == 'date' && $sort == 'descend') {
            $products = Product::orderBy('created_at', 'desc')->paginate(12);
        }
        elseif ($type == 'price' && $sort == 'descend') {
            $products = Product::orderBy('price', 'desc')->paginate(12);
        }
        else {
            $products = Product::orderBy('price', 'asc')->paginate(12);
        }
        
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 12);
    }

}
