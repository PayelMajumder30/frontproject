<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //

    public function create(){
        $users = User::where('role', '=', 'user')
                    ->get();
        return view('team.create', compact('users'));
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'team_name' => 'required|string|max:255',
            'members'   => 'required|array'
        ]);
    
        $teamLeaderId = auth()->id();
    
        // Check if a team already exists for this leader
        // $existingTeam = Team::where('team_leader_id', $teamLeaderId)->first();
        // if ($existingTeam) {
        //     return redirect()->back()->with('error', 'Already have a team');
        // }
        
        DB::beginTransaction();
        try {
            // Create the team
            $team = Team::create([
                'team_leader_id' => $teamLeaderId,
                'team_name'      => $request->team_name,
            ]);
    
            // Insert team members
            foreach ($request->members as $userId) {
                TeamMember::create([
                    'team_id' => $team->id,  // Fixed variable
                    'user_id' => $userId,
                ]);
            }

            DB::commit();
            // return redirect()->route('team.create')->with('success', 'Team created successfully.');
            return redirect()->back()->with('success', 'Team created successfully.');
    
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('failure', 'Failed to delete team member. Please try again.');
        }
    }
}
