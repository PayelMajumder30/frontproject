<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chatbox;

class AdminController extends Controller
{
    public function allUsers() {
         $users = User::where('role', 'User')->orderby('id','ASC')->get();
        // $users = User::whereHas('chatboxes', function ($query) {
        //     $query->where('receiver_id', 4); // Assuming admin ID is 4
        // })->get();

        return view('admin.list')->with(['users' => $users]);
    }

    public function chat($userId){
      $adminId = 4;

      $user = User::findOrFail($userId);
      $chats = Chatbox::where(function ($query) use ($userId, $adminId){
        $query->where('user_id', $userId)
            ->where('receiver_id', $adminId);
        })->orWhere(function ($query) use ($userId, $adminId){
            $query->where('user_id', $userId)
            ->where('sender', 'admin');
        })->orderBy('created_at', 'asc')->get();

      return view('admin.adminchat', compact('chats','userId', 'user'));
    }

    public function sendmessage(Request $request, $userId){
        $request->validate([
            'message'   => 'required|string'
        ]);

        Chatbox::create([
            'user_id'       => $userId,
            'sender'        => 'admin',
            'message'       => $request->message,
            'receiver_id'   => $userId
        ]);
        return redirect()->back();
    }
}