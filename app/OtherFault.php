<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherFault extends Model
{
    protected $table = 'other_fault';

    public function sjc()
    {
        return $this->belongsTo('App/Sjc');
    }
}
