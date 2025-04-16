<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $table = 'ledger';
    protected $fillable = ['user_id', 'transaction_number', 'transaction_amount', 'is_credit', 'is_debit', 'purpose', 'purpose_description'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class, 'transaction_number', 'invoice_number');
    }
}
