<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    //show reset password form
    public function showResetForm(){
        return view('auth.passwords.reset');
    }

     /**
     * Handle the password reset.
     */
    public function reset(Request $request)
    {
        //validate input
        $request->validate([
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);
        //Find the user by email
        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Password has been reset. Please login with your new password.');
    }
}
