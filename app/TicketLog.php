<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    protected $table = 'ticket_logs';
    protected $fillable = [
        'ticket_id',
        'user_id', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
