<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActTaken extends Model
{
    protected $table = 'act_taken';

    public function sjc()
    {
        return $this->belongsTo('App/Sjc');
    }
}
