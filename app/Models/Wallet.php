<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = "wallets";
    protected $fillable = ['user_id', 'wallet_balance', 'amount_added','created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
