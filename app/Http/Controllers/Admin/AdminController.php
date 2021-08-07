<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products_count = Product::all()->count();
        // $admins_count = User::where('role_id', 1)->count();
        // $users_count = User::where('role_id', 2)->count();
        
        $counts['Products'] = Product::all()->count();
        $counts['Admins'] = User::where('role_id', 1)->count();
        $counts['Users'] = User::where('role_id', 2)->count();
        $counts['Categories'] = Category::all()->count();
        $counts['Comments'] = Comment::all()->count();
        $class = ['bg-grow-early', 'bg-arielle-smile', 'bg-midnight-bloom'];

        return view('admin.dashboard.index', compact('counts', 'class'));
    }
}
