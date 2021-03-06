<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReserveManagement extends Model
{
    protected $table = 'reserve_managements';

    public function reserveDayLists()
    {
        return $this->belongsToMany('App\Model\ReserveDayList');
    }

    public function rooms()
    {
        return $this->belongsToMany('App\Model\Room');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
