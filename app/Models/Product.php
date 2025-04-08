<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table    = "products";
    protected $fillable = ['name', 'proce'];

    public function invoiceItem(){
        return $this->hasMany(InvoiceItem::class, 'product_id');
    }
}
