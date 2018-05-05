@extends('layouts.app')

@section('content')
<style media="screen">
.parent {
  height: 100%;
}
.tengah {
  height: 500px;
  width: 450px;
  margin: auto;
  padding: 0px 45px 45px;
  bottom: 13px;
  background-color: #fff;
  box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);
  top: 50px;
  position: relative;
}

.form-login {
  /*margin: auto;*/
  display: grid;
}

.judul {
  line-height: 12px;
  margin-left: 12px;
  margin-right: auto;
}

.home {
  padding-bottom: 12px;
  display: flex;
  border-bottom: 1px solid #eee;
  margin-bottom: 50px;
  text-decoration: none;

}

.home:hover{
  text-decoration: none;
}

.home img {
  margin-left: auto;
}

.bold {
  font-weight: bold;
}

.tengah-kepala {
  background: transparent linear-gradient(to right,#188fff 0,#400090 100%) repeat scroll 0 0;
  display: block;
  height: 4px;
  margin: 0 -45px 20px;
}

.input{
  width: -moz-available;
  border: none;
  background:transparent;
  border-bottom: 1px solid #eee;
  margin-bottom: 15px;
}

body, html{
  height: 100%;
}
</style>
<div id='mine' class="row">
    <div class="tengah">
      <span class="tengah-kepala"></span>
      <a class="home" href="{{ route('welcome') }}">
        <img src="/gambar/Unair_compressed.png" alt="logo-unair" height="50px" width="50px">
        <h2 class="judul">Sosialisasi PMB</h2>
      </a>
      <div class="tengah-dalem">
      <h4 class="bold">Masuk</h4>
        <form class="form-login" action="{{ route('login') }}" method="POST">
          {{ csrf_field() }}
          <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
            <span class="username-span"></span>
            <input type="text" class="input username" placeholder="Nama Pengguna" name="email" value="">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>

          <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="password-span"></span>
            <input type="password" class="input password" placeholder="Kata Sandi" name="password" value="">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>

          <input class="btn btn-primary" type="submit" value="Masuk">
        </form>
      </div>
    </div>
</div>
@endsection
