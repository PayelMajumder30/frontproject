<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'      => ['required', 'string'],
            'phone'     => ['required', 'string', 'max:20'],
            'address'   => ['required', 'string', 'max:250'],
            'gender'    => ['required', 'string', 'in:male,female,other'],
            'image'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $imagePath = null;
        if(isset($data['image']) && $data['image']->isValid()) {
            $extension  = $data['image']->extension(); 
            $fileName = time() . rand(10000, 99999) . '.' . $extension;
            $imagePath = 'uploads/profile_image/'. $fileName;

            $data['image']->move(public_path('uploads/profile_image'), $fileName);
            $data['image'] = $imagePath;
        }
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'role'      => $data['role'],
            'phone'     => $data['phone'],
            'address'   => $data['address'],
            'gender'    => $data['gender'],
            'image'     => $imagePath
        ]);
    }
}
