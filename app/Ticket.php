<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket_complaints';
    protected $fillable = [
        'ticket_id', 
        'company_id', 
        'pic_complaint', 
        'date_complaint', 
        'note', 
        'user_id', 
        'status',
        'pic_update',
        'pic_update_2',
        'pic_update_3'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function ticketlog()
    {
        return $this->hasMany('App\TicketLog');
    }
    public function picupdate()
    {
        return $this->belongsTo('App\User','pic_update');
    }
    public function picupdate2()
    {
        return $this->belongsTo('App\User','pic_update_2');
    }
    public function picupdate3()
    {
        return $this->belongsTo('App\User','pic_update_3');
    }
}
