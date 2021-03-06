<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewCommentNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        if ($product->comments->count() > 0){
            $comments = $product->comments()->paginate(10);
            return view('comments.index',compact('comments', 'product'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        return view('comments.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Product $product
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product,Request $request)
    {
        $comment = $product->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->input('body'),
        ]);

        $user = $product->user;
        if ($comment->user_id != $product->user_id) {
            $title = 'New Comment';
            $text = $comment->user->name . ' has commented on ' . $product->name;
            $route = route('products.comments.index', [$product->id]);
            $user->notify(new NewCommentNotification($title, $text, $route));
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());
        $id = $comment->product->id;
        return redirect()->route('products.comments.index', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
