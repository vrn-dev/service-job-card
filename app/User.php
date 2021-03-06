<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class User extends Model implements Authenticatable
{
    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    use \Illuminate\Auth\Authenticatable;

    public function companies()
    {
        return $this->hasMany('App\Company');
    }
    public function inventories()
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
