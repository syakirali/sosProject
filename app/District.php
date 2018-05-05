<?php

namespace sosProject;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false; // karena tabel 'provinces'nya tanpa timestamps

    public function regencie(){
        return $this->belongsTo('sosProject\Regencie', 'regency_id');
    }
}
