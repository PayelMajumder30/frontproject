<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;
use App\Models\{Team, Chatbox};
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function allUsers() {
         $users = User::with('teams')->where('role', 'User')->orderby('id','ASC')->get();
         $teams = Team::orderby('team_name', 'ASC')->get();
        // $users = User::whereHas('chatboxes', function ($query) {
        //     $query->where('receiver_id', 4); // Assuming admin ID is 4
        // })->get();

        return view('admin.list')->with(['users' => $users, 'teams' => $teams]);
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

    public function detailUsers(Request $request){
        //dd($request->all());
        $keyword    = $request->input('keyword');
        $users      = User::where('role', 'User')
            ->when($keyword, function($query) use ($keyword) {
            $query->where('name', 'like', '%'. $keyword . '%')
                ->orWhere('email', 'like', '%'. $keyword . '%')
                ->orWhere('phone', 'like', '%'. $keyword . '%')
                ->orWhere('address', 'like', '%'. $keyword . '%')
                ->orWhere('designation_id ', 'like', '%'. $keyword . '%');
        })->orderBy('id', 'ASC')->get();
        return view('admin.userdetails', compact('users'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $designations = Designation::where('status', '1')->get();
        return view('admin.edituser', compact('user', 'designations'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $id,
            'phone'         => 'nullable|string|max:20',
            'gender'        => 'nullable|string',
            'address'       => 'nullable|string|max:255',
            'designation_id'=> 'nullable|exists:designations,id'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'designation_id' => $request->designation_id
        ]);

        return redirect()->route('admin.userdetails')->with('success', 'User updated successfully!');
    }

    public function assignTeamLeader($id){
        
        User::where('is_team_leader', 1)->update(['is_team_leader' => 0]);
        $user = User::findOrFail($id);
        $user->is_team_leader = 1;
        $user->save();

        return redirect()->back()->with('success', 'User assigned as Team Leader successfully.');
    }
   
}