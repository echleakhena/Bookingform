<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id', 'name', 'phone', 'branch_id', 'service_id', 
    'know_through', 'booking_date', 'booking_time', 
    'status', 'note', 'payment', 'image'
];

            // Relationships
            public function user()
            {
                return $this->belongsTo(User::class,'user_id');
            }

            public function branch()
            {
                return $this->belongsTo(Branch::class,'branch_id');
            }

                public function service()
                {
                    return $this->belongsTo(Service::class,'service_id');
                }
                
             protected $casts = [
    'booking_date' => 'datetime',
    'booking_time' => 'datetime',
];




}