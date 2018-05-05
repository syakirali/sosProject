@extends('layouts.app')

@section('content')
<style media="screen">
  @media only screen and (min-width: 970px) {
    #my-row {
        display: table;
    }

    #my-row .panel {
        float: none;
        display: table-cell;
        vertical-align: middle;
    }
  }
  .beranda-profile{
    width: -moz-available;
  }
  body{
   min-width:360px; /* suppose you want minimun width of 1000px */
   width: auto !important;  /* Firefox will set width as auto */
   width:360px;             /* As IE ignores !important it will set width as 1000px; */
  }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Beranda</div>

                <div class="panel-body">
                    <div id="my-row" class="row" style="border-rigth:1px solid #ffff">
                        <div class="col-md-4 col-sm-4 col-xs-12 panel">
                            <a href="{{ $picture }}">
                            <img id="profil" src="{{ $picture }}" class="img-circle img-responsive" alt="Foto Profil">
                            </a>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 panel" style="height:100%">
                          <div class="tn">
                            <div class="row tng">
                                <label for="nama" class="col-md-4 col-sm-4 col-xs-5 col-md-offset-1">Nama</label>
                                <div id="nama" class="col-md-7 col-sm-7 col-xs-6">{{ $user->name }}</div>
                            </div>
                            <div class="row tng">
                                <label for="email" class="col-md-4 col-sm-4 col-xs-5 col-md-offset-1">E-mail</label>
                                <div id="email" class="col-md-7 col-sm-7 col-xs-6">{{ $user->email }}</div>
                            </div>
                            <div class="row tng">
                                <label for="gender" class="col-md-4 col-sm-4 col-xs-5 col-md-offset-1">Gender</label>
                                <div id="gender" class="col-md-7 col-sm-7 col-xs-6">{{ $user->gender == 'L' ? 'Laki-laki':'Perempuan' }}</div>
                            </div>
                            <div class="row tng">
                                <label for="position_id" class="col-md-4 col-sm-4 col-xs-5 col-md-offset-1">Posisi</label>
                                <div id="position_id" class="col-md-7 col-sm-7 col-xs-6">{{ $user->jabatan }}</div>
                            </div>
                            <div class="row tng">
                                <label for="tgl_lahir" class="col-md-4 col-sm-4 col-xs-5 col-md-offset-1">Tanggal Lahir</label>
                                <div id="tgl_lahir" class="col-md-7 col-sm-7 col-xs-6">{{ $user->tgl_lahir }}</div>
                            </div>
                            <div class="row tng">
                                <label for="tempat_lahir" class="col-md-4 col-sm-4 col-xs-5 col-md-offset-1">Tempat Lahir</label>
                                <div id="tempat_lahir" class="col-md-7 col-sm-7 col-xs-6">{{ $user->tempat_lahir }}</div>
                            </div>
                            <div class="row tng">
                                <label for="no_telp" class="col-md-4 col-sm-4 col-xs-5 col-md-offset-1">Nomor Telepon</label>
                                <div id="no_telp" class="col-md-7 col-sm-7 col-xs-6">{{ $user->no_telp }}</div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <form id="profile" style="margin-top:10px;" action="{{ route('petugas PP') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" class="col-md-4 col-sm-4 col-xs-12" name="profile" accept="image/*" required>
                            <input type="hidden" name="_method" value="put">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="submit" class="btn btn-primary btn-sm col-md-3 col-md-offset-1" value="upload">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
