<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'location',
        'manager',
        'phone',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    

    
}
