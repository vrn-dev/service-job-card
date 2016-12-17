<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fnw extends Model
{
    protected $table = 'fnw';

    public function sjc()
    {
        return $this->belongsTo('App/Sjc');
    }
}
