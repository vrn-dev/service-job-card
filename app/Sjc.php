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
    public function fnw()
    {
        return $this->hasMany('App\Fnw');
    }
    public function otherFault()
    {
        return $this->hasOne('App\OtherFault');
    }
    public function actTaken()
    {
        return $this->hasMany('App\ActTaken');
    }
    public function otherAction()
    {
        return $this->hasOne('App\OtherAction');
    }
    public function repPart()
    {
        return $this->hasMany('App\RepPart');
    }
    public function noc()
    {
        return $this->hasOne('App\Noc');
    }
}
