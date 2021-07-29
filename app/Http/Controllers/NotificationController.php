<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $notifications = auth()->user()->notifications;
       return view('notifications.index', compact('notifications'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $notification = auth()->user()->notifications()->where('id', $id)->firstOrFail();
       $notification->markAsRead();

       return redirect($notification->data['route']);
    }
}
