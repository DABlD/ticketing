<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TransactionAttribute;
use App\Models\Ticket;

class Transaction extends Model
{
    use TransactionAttribute;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "ticket_id","fname","mname",
        "lname","gender","birthday",
        "contact","email","address",
        'status','mop','ref',
        'crypt','company', 'position'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'birthday'
    ];

    public function ticket(){
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}