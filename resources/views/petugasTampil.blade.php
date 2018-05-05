@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    List Petugas
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Gender</th>
                            <th>Posisi</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                        <tbody>
                          @foreach($users as $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->no_telp }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>
                              <div>
                                <div class="">
                                  <div class="btn-group-xs">
                                    <a class="btn btn-warning" onclick="return confirm('{{ $user->name }}  beserta agenda dan laporannya akan dihapus !')" href="/home/petugas/{{ $user->id }}/hapus">hapus</a>
                                  </div>
                                </div>
                              </div>
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
