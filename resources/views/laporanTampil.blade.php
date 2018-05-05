@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    List Laporan
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                          <th class="col-md-2">ID Agenda</th>
                          <th class="col-md-4">Uraian</th>
                          <th class="col-md-4">Kendala</th>
                          <th class="col-md-2">Aksi</th>
                        </tr>
                        <tbody>
                          @foreach($reports as $report)
                          <tr>
                            <td>{{ $report->agenda_id }}</td>
                            <td>{{ $report->uraian }}</td>
                            <td>{{ $report->kendala }}</td>
                            <td class="btn-group-xs">
                                <a href="/home/laporan/{{ $report->id }}/detail" class="btn btn-primary">Detail</a>
                                <a href="/home/laporan/{{ $report->id }}/hapus" onclick="return confirm('Laporan ID Agenda {{ $report->id }} akan dihapus !')" class="btn btn-warning">Hapus</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    @if(count($reports) == 0)
                    <div id="notifikasi" class="alert alert-danger" role="alert">
                      Tidak ada data untuk ditampilkan
                      <button class="close" onclick="document.getElementById('notifikasi').style.display = 'none'">
                        <span>&times;</span>
                      </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
