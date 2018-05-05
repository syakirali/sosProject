<?php

namespace sosProject;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    public $timestamps = false; // karena tabel 'provinces'nya tanpa timestamps

    public function district(){
        // dd($this);
        return $this->belongsTo('sosProject\District');
    }
}
