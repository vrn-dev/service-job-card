<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sjc extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    public function inventory()
    {
        return $this->belongsTo('App\Inventory');
    }
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
