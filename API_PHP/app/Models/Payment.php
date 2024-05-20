<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model{

    protected $table = 'payments';
    protected $fillable = [
        'value',
        'payment_method',
        'status',
        'payment_date'
    ];

    protected $hidden = [];

    protected $casts = [
        'payment_date' => 'datetime',
        'value' => 'float'
    ];  
}