<?php

namespace sosProject;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
  public $timestamps = false; // karena tabelnya tanpa timestamps

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'agenda_id', 'user_id'
  ];
}
