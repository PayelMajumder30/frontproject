<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $table = "invoice_items";
    protected $fillable = ['invoice_id', 'product_id', 'quantity', 'amount', 'items_per_amount'];

    public function invoice(){
        return $this->belongsTo('invoice_id', 'id');
    }

    public function product(){
        return $this->belongsTo('product_id', 'id');
    }
}
