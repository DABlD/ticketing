<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EventAttribute;
use App\Models\Ticket;

class Event extends Model
{
    use SoftDeletes, EventAttribute;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','description','date','start_time','end_time','venue','venue_address','ticket','images','category', 'layout'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'date'
    ];

    public function tickets(){
        return $this->hasMany(Ticket::class, 'event_id', 'id');
    }
}