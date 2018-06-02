<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket_complaints';
    protected $fillable = [
        'ticket_id', 'company_id', 'pic_complaint', 'date_complaint', 'note', 'user_id', 'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
