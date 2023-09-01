<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TicketAttribute;
use App\Models\Event;

class Ticket extends Model
{
    use SoftDeletes, TicketAttribute;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id','type','price','stock','sale_until','sale_price', 'end_date', 'status'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'end_date', 'sale_until'
    ];

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}