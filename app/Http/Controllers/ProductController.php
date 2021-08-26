<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image as ImageResize;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $sort = $request->input('sort');
        $from = $request->input('from');
        $to = $request->input('to');

        $products = Product::where('available', 1);

        if ($type == 'date' && $sort == 'ascend') {
            $products = $products->orderBy('created_at', 'asc');
        } elseif ($type == 'date' && $sort == 'descend') {
            $products = $products->orderBy('created_at', 'desc');
        } elseif ($type == 'price' && $sort == 'descend') {
            $products = $products->orderBy('price', 'desc');
        } elseif ($type == 'price' && $sort == 'ascend') {
            $products = $products->orderBy('price', 'asc');
        } elseif ($from && $to) {
            $products = $products->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
        } else {
            $products = $products->latest();
        }

        $products = $products->paginate(15);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guestProduct()
    {
        $products = Product::where('available', 1)->latest()->paginate(12);
        return view('welcome', compact('products'))
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
        $product = $request->only([
            'name',
            'price',
            'phone',
            'address',
            'description',
        ]);

        $category = Category::where('id', $request->input('category'))->first();

        foreach ($request->file('images') as $key => $value) {
            $extension = $value->getClientOriginalExtension();
            $image = time() . $key . '.' . $value->getClientOriginalExtension();
            $img = ImageResize::make($value->path())->resize(183, 148.8)->encode($extension);
            Storage::disk('public')->put($path = "images/" . $image, (string) $img);
            $images[] = $image;
        }

        return view('products.confirmCreate', compact('product', 'category', 'images'));
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

        foreach ($request->input('images') as $value) {
            $image = new Image(['name' => $value]);
            $product->images()->save($image);
        }
        return redirect()->route('products.index')
            ->with('success', 'Product uploaded successfully.');
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
                } else {
                    $favourited = 0;
                }
            }
        } else {
            $favourited = 0;
        }

        $relatedProducts = $product->category->products()->inRandomOrder()->take(6)->get();

        $userProducts = $product->user->products()->inRandomOrder()->take(6)->get();

        return view('products.show', compact('product', 'favourited', 'relatedProducts', 'userProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

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
        $this->authorize('update', $product);

        $edited_product = $request->only([
            'name',
            'price',
            'phone',
            'address',
            'description',
        ]);

        $edited_product['available'] = $request->input('available') ? $request->input('available') : 0;

        $category = Category::where('id', $request->input('category'))->first();

        if ($request->file('images')) {
            foreach ($request->file('images') as $key => $value) {
                $image = time() . $key . '.' . $value->getClientOriginalExtension();
                $value->move(public_path('images'), $image);
                $images[] = $image;
            }
        } else {
            foreach ($product->images as $key => $value) {
                $images[] = $value->name;
            }
        }

        $id = $product->id;

        return view('products.confirmEdit', compact('edited_product', 'category', 'images', 'id'));
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
        $this->authorize('update', $product);

        DB::table('products')
            ->where('id', $product->id)
            ->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category'),
                'price' => $request->input('price'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'description' => $request->input('description'),
                'available' => $request->input('available'),
            ]);

        $product_images = $product->images;
        foreach ($product_images as $product_image) {
            $product_image->delete();
        }

        foreach ($request->input('images') as $value) {
            $image = new Image(['name' => $value]);
            $product->images()->save($image);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
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
}
