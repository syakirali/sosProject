<?php

namespace sosProject;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  public $timestamps = false; // karena tabelnya tanpa timestamps

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'agenda_id', 'uraian', 'kendala', 'photos_path', 'document_path',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'id'
  ];

  /**
   * untuk 'melindungi' kolom
   *
   * @var array
   */
  protected $guarded = [
      'id'
  ];
}
