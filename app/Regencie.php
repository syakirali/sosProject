<?php

namespace sosProject;

use Illuminate\Database\Eloquent\Model;

class Regencie extends Model
{
    public $timestamps = false; // karena tabel 'provinces'nya tanpa timestamps

    public function province(){
        return $this->belongsTo('sosProject\Province');
    }
}
