<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chatbox;
use Illuminate\Support\Facades\DB;

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

      $user     = User::findOrFail($userId);
      $chats    = Chatbox::where(function ($query) use ($userId, $adminId){
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

    public function getUnreadMessages(){
        $messages = Chatbox::select('user_id', DB::raw('COUNT(*) as message_count'), DB::raw('MAX(created_at) as latest_message_time'))
                    ->where('receiver_id', 4)
                    ->where('sender', 'user')
                    ->groupBy('user_id')
                    ->get();

        // Format messages with "time ago" calculation
        foreach ($messages as $msg) {
            $msg->user      = User::find($msg->user_id); // Fetch user details
            $msg->time_ago  = Carbon::parse($msg->latest_message_time)->diffForHumans();
        }
        return response()->json($messages);
    }

    public function detailUsers(){
        $users = User::where('role', 'User')->orderBy('id', 'ASC')->get();
        return view('admin.userdetails', compact('users'));
    }
   
}