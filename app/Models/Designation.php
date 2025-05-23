<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $table    = "designations";
    protected $fillable = ['title', 'status'];

    public function users(){
        return $this->hasMany(User::class, 'designation_id');
    }
}
