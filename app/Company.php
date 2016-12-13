<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['companyName', 'contactName', 'contactTel','contactMobile', 'contactEmail', 'city', 'country', 'address'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
    public function sjcs()
    {
        return $this->hasMany('App\Sjc');
    }
}
