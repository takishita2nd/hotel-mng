<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class reserve_day_list extends Model
{
    protected $table = 'reserve_day_lists';

    public function hasDayListAndManagement()
    {
        return $this->belongsTo('App\Model\reserve_day_lists_reserve_managements', 'id', 'reserve_day_lists_id');
    }
}
