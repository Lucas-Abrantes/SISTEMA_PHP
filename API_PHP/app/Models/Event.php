<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model{
   
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'data',
        'location',
        'organizador',
        'capacity',
        'price'
    ];

    protected $casts = [
        'data' => 'datetime',
        'price' => 'decimal:2'
    ];

    
    public function organizer(){
        return $this->belongsTo(User::class, 'organizador');
    }
}
