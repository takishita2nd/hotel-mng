<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class reserve_management extends Model
{
    protected $table = 'reserve_managements';

    public function belongsTo()
    {
        return $this->belongsTo('App\Model\reserve_day_lists_reserve_managements', 'id', 'reserve_managements_id');
    }
}
