<?php

namespace sosProject;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{

      public $timestamps = false; // karena tabel 'sgendas'nya tanpa timestamps

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'tanggal', 'nama_agenda', 'village_id', 'alamat', 'instansi'
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

      public function report(){
          return $this->hasOne('sosProject\Report');
      }

      public function users(){
          return $this->belongsToMany('sosProject\User', 'officers');
      }
}
