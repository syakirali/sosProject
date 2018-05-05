@extends('layouts.app')

@section('content')
<style media="screen">
  .glyphicon{
    color: #337ab7;
  }
  .officers{
    padding:0;
  }
  .officers li{
    display: block;
  }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    List Agenda
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Nama Agenda</th>
                            <th>Pelaksanaan</th>
                            <th>Tempat</th>
                            <th>Alamat</th>
                            <th>Instansi</th>
                            @if(Auth::user()->position_id == 1)
                            <th>Pelaksana</th>
                            @endif
                            <th>Laporan</th>
                            @if(Auth::user()->position_id == 1)
                            <th>Aksi</th>
                            @endif
                        </tr>
                        <tbody>
                          @foreach($agendas as $agenda)

                          @if($agenda[0]->status)
                          <tr class="info">
                          @elseif(strtotime($agenda[0]->tanggal) < strtotime(date('Y-m-d')))
                          <tr class="danger">
                          @else
                          <tr>
                          @endif
                            <td>{{$agenda[0]->nama_agenda}}</td>
                            <td>{{$agenda[0]->tanggal}}</td>
                            <td>
                              <strong>Desa</strong> {{ ucwords(strtolower($villages[$agenda[0]->village_id]->name)) }},
                              <strong>Kecamatan</strong> {{ ucwords(strtolower($districts[$agenda[0]->village_id]->name)) }},
                              <strong>Kabupaten</strong> {{ ucwords(strtolower($regencies[$agenda[0]->village_id]->name)) }},
                              <strong>Provinsi</strong> {{ ucwords(strtolower($provinces[$agenda[0]->village_id]->name)) }}
                            </td>
                            <td>{{$agenda[0]->alamat}}</td>
                            <td>{{$agenda[0]->instansi}}</td>
                            @if(Auth::user()->position_id == 1)
                            <td>
                              <ul class="officers">
                                  @foreach($agenda as $person)
                                  <li>{{ $person->name }}</li>
                                  @endforeach
                              </ul>
                            </td>
                            @endif
                            <td>
                                @if($agenda[0]->status)
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                  selesai
                                @else
                                  @if(strtotime($agenda[0]->tanggal) < strtotime(date('Y-m-d')))
                                    @if(Auth::user()->position_id != 1)
                                      <div class="btn-group btn-group-xs">
                                        <a class="btn btn-primary" href="/home/laporan/tambah/{{$agenda[0]->id}}">Buat Laporan</a>
                                      </div>
                                    @else
                                      Belum Dibuat
                                    @endif
                                  @else
                                    Belum Tersedia
                                  @endif
                                @endif
                            </td>
                            @if(Auth::user()->position_id == 1)
                            <td>
                                <a class="btn btn-warning btn-xs" href="/home/agenda/{{ $agenda[0]->id }}/hapus" onclick="return confirm('yakin menghapus agenda {{ $agenda[0]->nama_agenda }}?')">Hapus</a>
                            </td>
                            @endif
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
