<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\PasswordChangeNotification;

class ChangePasswordController extends Controller
{
    /**
    * Display the change-password view.
    *
    * @return \Illuminate\Http\Response
    */
   public function show()
   {
       return view('auth.change-password');
   }

   /**
     * Handle an incoming password-change request.
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = User::find(auth()->user()->id);
        $user->update(['password'=> Hash::make($request->new_password)]);
        $title = 'Password Changed';
        $text = 'Your password has changed successfully';
        $route = route('users.show', [$user]);
        $user->notify(new PasswordChangeNotification($title, $text, $route));
   
        return redirect()->route('users.show', [$user])
        ->with('success','password changed successfully.');
    }
}
