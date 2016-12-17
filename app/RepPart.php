<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepPart extends Model
{
    protected $table = 'rep_part';

    public function sjc()
    {
        return $this->belongsTo('App/Sjc');
    }
}
