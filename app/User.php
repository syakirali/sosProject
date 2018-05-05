<?php

namespace sosProject;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
      use Notifiable;

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'name', 'email', 'password', 'gender', 'position_id', 'tgl_lahir', 'avatar', 'tempat_lahir', 'alamat', 'no_telp',
      ];

      /**
       * The attributes that should be hidden for arrays.
       *
       * @var array
       */
      protected $hidden = [
          'password', 'remember_token',
      ];

      /**
       * untuk 'melindungi' kolom
       *
       * @var array
       */
      protected $guarded = [
        'id', 'rememberToken', 'created_at', 'updated_at'
      ];

      public function agendas(){
          return $this->belongsToMany('sosProject\Agenda', 'officers');
      }

      public function position(){
          return $this->hasOne('sosProject\Position', 'id', 'position_id');
      }
}
