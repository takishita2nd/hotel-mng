<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    public function reserveManagement()
    {
        return $this->belongsToMany('App\Model\ReserveManagement');
    }
}
