<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model{
    
    protected $table = 'subscribers';

    protected $fillable = [
        'name',
        'telefone',
        'event_id',
        'subscribe_date',
        'status'
    ];

    protected $casts = [
        'subscribe_date' => 'datetime',
        'status' => 'boolean'
    ];
   
    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }
}