<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "ticket_id","fname","mname",
        "lname","gender","birthday",
        "contact","email","address",
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'birthday'
    ];

    public function event(){
        return $this->belongsTo(Event::class, 'id', 'event_id');
    }
}