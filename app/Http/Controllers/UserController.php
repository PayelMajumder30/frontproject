<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chatbox;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index($userId){
        $adminId    = 4;
        $user       = User::findOrFail($userId);
        $userId     = Auth::id();
    
        $chats = Chatbox::where(function ($query) use ($userId, $adminId) {
            $query->where('user_id', $userId)
                  ->where('receiver_id', $adminId);
        })->orWhere(function ($query) use ($userId, $adminId) {
            $query->where('user_id', $userId)
                  ->where('sender', 'admin');
        })->orderBy('created_at', 'asc')->get();
    
        return view('users.chat', compact('chats', 'userId', 'user'));
    }    

    public function sendmessage(Request $request){
        $request->validate([
            'message'   => 'required|string'
        ]);

        $userId = Auth::id();
        Chatbox::create([
            'user_id'       => $userId,
            'sender'        => 'user',
            'message'       => $request->message,
            'receiver_id'   => 4
        ]);
        return redirect()->back();
    }
}
