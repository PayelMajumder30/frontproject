<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoice";
    protected $fillable = ['total_amount', 'user_id', 'user_name', 'address', 'email', 'invoice_number'];

    public function items(){
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    

}
