<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function allUsers() {
        $users = User::where('role', 'user')->orderby('id','DESC')->get();

        return view('users.list')->with(['users' => $users]);
    }
}
