<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class reserve_day_lists_reserve_managements extends Model
{
    protected $table = 'reserve_day_lists_reserve_managements';

    public function hasManagement()
    {
        return $this->hasMany('App\Model\ReserveManagement', 'id', 'reserve_managements_id');
    }

    public function hasDayList()
    {
        return $this->hasMany('App\Model\reserve_day_list', 'id', 'reserve_day_lists_id');
    }
}
