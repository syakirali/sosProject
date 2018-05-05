@extends('layouts.app')

@section('content')

<style media="screen">
  .detail{
    width: 100%;
  }
  .gallery {
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 5px;
      border: 1px solid #a2bac0;
  }

  .gallery:hover {
      border: 1px solid #75868a;
  }

  .gallery-item {
      margin: 20px;
  }
  .thumbnail {
      border: 1px solid #FFFAF0;
      width: 500;
      height: auto;
  }
  .row{
      margin-bottom: 10px;
  }

</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Detail laporan <strong>{{ $laporan->nama_agenda }}</strong>
                </div>
                <div class="panel-body">
                    <!-- <div class="form-horizontal"> -->
                    <div class="row">
                      <label for="agenda" class="col-md-4 col-md-offset-1">Nama Agenda</label>
                      <div class="col-md-7" id="agenda">
                          <div class="detail">
                              {{ $laporan->nama_agenda }}
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <label for="tanggal" class="col-md-4 col-md-offset-1">Tanggal Pelaksanaan</label>
                      <div class="col-md-7">
                          <div class="detail" id="tanggal">
                              {{ $laporan->tanggal }}
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <label for="alamat" class="col-md-4 col-md-offset-1">Alamat Pelaksanaan</label>
                      <div class="col-md-7">
                          <div id="detail" class="detail" id="alamat">
                              {{ $laporan->alamat }}
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <label for="uraian" class="col-md-4 col-md-offset-1">Uraian</label>
                      <div class="col-md-7">
                          <div class="detail" id="uraian">
                              {{ $laporan->uraian }}
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <label for="kendala" class="col-md-4 col-md-offset-1">Kendala</label>
                      <div class="col-md-7">
                          <div class="detail" id="kendala">
                              {{ $laporan->kendala }}
                          </div>
                      </div>
                    </div>
                    <!-- </div> -->
                    <hr>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                          <div class="text-center"><strong>Dokumentasi Acara</strong></div>
                          @foreach($photos_path as $path)
                          <a href="{{ Storage::url($path) }}">
                            <div class="gallery">
                                <img class=".img-responsive" src="{{ Storage::url($path) }}" alt="{{ Storage::url($path) }}">
                            </div>
                          </a>
                          @endforeach
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
