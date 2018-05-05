@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active">
          <a data-toggle="collapse" href="#agenda" aria-expanded="false" aria-controls="agenda">Agenda</a>
        </li>
        <div class="collapse" id="agenda">
          <ul class="list-group">
            <a class="list-group-item" href="#">List Agenda</a>
            <a class="list-group-item" href="/home/tambahAgenda">Tambah Agenda</a>
          </ul>
        </div>

        <li role="presentation">
          <a data-toggle="collapse" href="#petugas" aria-expanded="false" aria-controls="petugas">Petugas</a>
        </li>
        <div class="collapse" id="petugas">
          <ul class="list-group">
            <a class="list-group-item" href="#">List Petugas`</a>
            <a class="list-group-item" href="{{ url('/register') }}">Tambah Petugas</a>
          </ul>
        </div>

        <li role="presentation">
          <a data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="home">Laporan</a>
        </li>
        <div class="collapse" id="laporan">
          <ul class="list-group">
            <a class="list-group-item" href="#">List laporan`</a>
            <a class="list-group-item" href="#">Tambah laporan</a>
          </ul>
        </div>
      </ul>
    </div>
    <div class="col-md-10">
      @yield('content');
      <a href="#">content</a>
    </div>
  </div>
</div>
@endsection
