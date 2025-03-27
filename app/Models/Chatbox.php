<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbox extends Model
{
    use HasFactory;
    protected $table    = "chatboxes";
    protected $fillable = ['user_id', 'sender', 'message', 'receiver_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
