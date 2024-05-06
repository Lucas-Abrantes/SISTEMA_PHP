<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model{
    
    protected $table = 'subscribers';

    protected $fillable = [
        'user_id',
        'event_id',
        'subscribe_data',
        'status'
    ];

    protected $casts = [
        'subscribe_data' => 'datetime',
        'status' => 'boolean'
    ];

  
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

   
    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }
}