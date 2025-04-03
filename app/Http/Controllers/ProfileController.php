<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function view(){
        return view('profile.view');
    }

    public function edit(){
        return view('profile.edit', ['user' => Auth::user()]);
    }
    public function update(Request $request){
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:255',
            'password'  => 'nullable|min:6|confirmed',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->address  = $request->address;


        if($request->password){
            $user->password = bcrypt($request->password);
        }

        //Handle image upload
        if($request->hasFile('image')){
            if(!empty($user->image) && file_exists(public_path($user->image))){
                unlink(public_path($user->image));
            }

            //upload new image
            $file       = $request->file('image');
            $fileName   = time(). rand(10000,99999) . '.' . $file->extension();
            $imagepath  = 'uploads/profile_image/' . $fileName;
            $file->move(public_path('uploads/profile_image/'), $fileName); 

            //Save the new image path in the database
            $user->image = $imagepath;
        }

        $user->save();
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

}
