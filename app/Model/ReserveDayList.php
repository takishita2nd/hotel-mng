<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReserveDayList extends Model
{
    protected $table = 'reserve_day_lists';

    public function reserveManagements()
    {
        return $this->belongsToMany('App\Model\ReserveManagement');
    }
}
