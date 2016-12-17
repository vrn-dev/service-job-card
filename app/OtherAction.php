<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherAction extends Model
{
    protected $table = 'other_action';

    public function sjc()
    {
        return $this->belongsTo('App/Sjc');
    }
}
