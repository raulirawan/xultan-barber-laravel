<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'users_id','code_booking','date_time','status','barber'
    ];

    protected $hidden = [
          
    ];
    
    protected $dates = [
        'date_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

 
}
