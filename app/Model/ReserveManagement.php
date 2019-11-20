<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReserveManagement extends Model
{
    protected $table = 'reserve_managements';

    public function belongsToTable()
    {
        return $this->belongsTo('App\Model\reserve_day_lists_reserve_managements', 'id', 'reserve_managements_id');
    }
}
