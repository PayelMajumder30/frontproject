<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table    = "teams";
    protected $fillable = ['team_leader_id', 'team_name'];

    public function members(){
        return $this->hasMany(TeamMember::class, 'team_id');
    }
}
