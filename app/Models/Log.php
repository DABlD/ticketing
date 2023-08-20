<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Log;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'action'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}