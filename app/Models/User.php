<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
        'address',
        'phone',
        'gender',
        'designation_id',
        'is_team_leader'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin($role)
    {
        if (strtoupper($role) == 'ADMIN') {
            return true;
        }
        return false;
    }
    public function isUser($role)
    {
        if (strtoupper($role) == 'USER') {
            return true;
        }
        return false;
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'team_leader_id');
    }

    public function chatboxes(): HasMany
    {
        return $this->hasMany(Chatbox::class, 'user_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function invoice(){
        return $this->hasMany(Invoice::class, 'user_id');
    }

    public function wallet() {
        return $this->hasMany(Wallet::class, 'user_id');
    }

    public function ledger() {
        return $this->hasMany(ledger::class, 'user_id');
    }
}
