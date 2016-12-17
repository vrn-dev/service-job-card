<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noc extends Model
{
    protected $table = 'noc';

    public function sjc()
    {
        return $this->belongsTo('App/Sjc');
    }
}
