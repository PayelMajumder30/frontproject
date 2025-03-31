<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function edit(){
        return view('profile.edit', ['user' => Auth::user()]);
    }
    public function update(Request $request){
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:6|confirmed',
        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

}
