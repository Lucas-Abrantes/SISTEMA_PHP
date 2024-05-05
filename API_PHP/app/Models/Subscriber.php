<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscribers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
        'evento_id',
        'subscribe_data',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'subscribe_data' => 'datetime',
        'status' => 'boolean'
    ];

    /**
     * Get the user associated with the subscriber.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

   
    public function event(){
        return $this->belongsTo(Event::class, 'evento_id');
    }
}
