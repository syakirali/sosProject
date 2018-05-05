@extends('layouts.app')

@section('content')

<style media="screen">
    .kanan{
        margin-left: auto;
    }
    .kiri{
        margin-right: 10px;
        width: auto;
    }
</style>

<div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="panel panel-info">
              <div class="panel-heading">
                  <strong>Agenda yang akan datang</strong>
              </div>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nama Agenda</th>
                      <th>Pelaksanaan</th>
                      <th>Tempat</th>
                      <th>Alamat</th>
                      <th>Instansi</th>
                      <th>Pelaksana</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($agendas as $agenda)
                      <tr>
                        <td>{{ $agenda[0]['nama_agenda'] }}</td>
                        <td>{{ $agenda[0]['tanggal'] }}</td>
                        <td>
                          <strong>Desa</strong> {{ ucwords(strtolower($village[$agenda[0]['village_id']]->name)) }},
                          <strong>Kecamatan</strong> {{ ucwords(strtolower($district[$agenda[0]['village_id']]->name)) }},
                          <strong>Kabupaten</strong> {{ ucwords(strtolower($regency[$agenda[0]['village_id']]->name)) }},
                          <strong>Provinsi</strong> {{ ucwords(strtolower($province[$agenda[0]['village_id']]->name)) }}
                        </td>
                        <td>{{ $agenda[0]['alamat'] }}</td>
                        <td>{{ $agenda[0]['instansi'] }}</td>
                        <td>
                            @foreach($agenda as $piece)
                            <div class="a" style="display:flex;">
                              <div class="kiri">
                                {{ $piece['name'] }}
                              </div>
                              <div class="kanan">
                                {{ $piece['no_telp'] }}
                              </div>
                            </div>
                            @endforeach
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection
