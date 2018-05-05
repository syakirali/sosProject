@extends('layouts.app')

@section('content')
<style media="screen">
  .selected{
    display: flex;
  }
  .petugas{
    margin-right: 20px;
  }
</style>

<div class="container">
    @if(isset($sukses))
    <div class="row" id='notifikasi'>
        <div class="col-md-8 col-md-offset-2">
            @if($sukses)
            <div class="alert alert-success" role="alert">
              Sukses Menambahkan Agenda
            @else
            <div class="alert alert-danger" role="alert">
              Gagal Menambahkan Agenda
            @endif
              <button class="close" onclick="document.getElementById('notifikasi').style.display = 'none'">
                <span>&times;</span>
              </button>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Buat Agenda Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('agenda tambah') }}" onsubmit="check()">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('nama_agenda') ? ' has-error' : '' }}">
                            <label for="nama_agenda" class="col-md-4 control-label">Nama Agenda</label>

                            <div class="col-md-6">
                                <input id="nama_agenda" type="text" class="form-control" placeholder="Nama Agenda" name="nama_agenda" value="{{ old('nama_agenda') }}" required autofocus>

                                @if ($errors->has('nama_agenda'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_agenda') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('instansi') ? ' has-error' : '' }}">
                            <label for="instansi" class="col-md-4 control-label">Instansi</label>

                            <div class="col-md-6">
                                <input id="instansi" type="text" placeholder="Instansi Tempat Pelaksanaan" class="form-control" name="instansi" value="{{ old('instansi') }}" required>

                                @if ($errors->has('instansi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instansi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('provinces') ? ' has-error' : '' }}">
                            <label for="provinces" class="col-md-4 control-label">Provinsi</label>
                            <div class="col-md-6">
                              <select class="form-control" name="provinces" id="provinces" onchange="createOption('provinces')">
                                <option value="">-pilih-</option>
                                @foreach($provices as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('provinces'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('provinces') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('regencies') ? ' has-error' : '' }}">
                          <label for="regencies" class="col-md-4 control-label">Kabupaten</label>
                          <div class="col-md-6">
                            <select class="form-control" name="regencies" id="regencies" onchange="createOption('regencies')"></select>

                            @if ($errors->has('regencies'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('regencies') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group{{ $errors->has('districts') ? ' has-error' : '' }}">
                          <label for="districts" class="col-md-4 control-label">Kota</label>
                          <div class="col-md-6">
                            <select class="form-control" name="districts" id="districts" onchange="createOption('districts')"></select>

                            @if ($errors->has('districts'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('districts') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group{{ $errors->has('villages') ? ' has-error' : '' }}">
                          <label for="villages" class="col-md-4 control-label">Desa</label>
                          <div class="col-md-6">
                            <select class="form-control" name="villages" id="villages"></select>

                            @if ($errors->has('villages'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('villages') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
                            <label for="tanggal" class="col-md-4 control-label">Tanggal Acara</label>
                            <div class="col-md-6">
                                <input type="date" placeholder="Tahun-Bulan-Tanggal" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal') }}">

                                @if ($errors->has('tanggal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>
                            <div class="col-md-6">
                              <textarea id="alamat" placeholder="Alamat" name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                              @if ($errors->has('alamat'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('alamat') }}</strong>
                                  </span>
                              @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('petugas_id') ? ' has-error' : '' }}">
                            <label for="petugas_id" class="col-md-4 control-label">Petugas</label>

                            <div class="col-md-6">
                                <select class="form-control" id="spetugas_id" name="spetugas_id" onchange="tambahPegawai()">
                                    <option value="">-pilih-</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                </select>

                                <div class="row" id="selected"></div>

                                @if ($errors->has('Petugas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Petugas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function tambahPegawai(){
    var selectElm = document.getElementById('spetugas_id');
    if (selectElm.value !== '') {
        var selected = document.getElementById('selected');
        var petugas = document.createElement('div');
        petugas.id = 'id-'+selectElm.value;
        petugas.setAttribute('class', 'col-md-4 col-sm-4 col-xs-6');
        // var name = 'id'+selectElm.value;
        // petugas.setAttribute('name', name);

        var input = document.createElement('input');
        input.setAttribute('value', selectElm.value);
        input.setAttribute('name', 'petugas_id[]');
        input.style.display = 'none';
        petugas.appendChild(input);

        var button = document.createElement('button');
        button.type = 'button';
        button.setAttribute('class','close');
        var action = "remove('id-"+ selectElm.value +"')";
        button.setAttribute('onclick', action);

        var span  = document.createElement('span');
        span.innerHTML = '&times;';
        button.appendChild(span);

        var option = selectElm.options[selectElm.selectedIndex];
        option.style.display = 'none';

        petugas.appendChild(option);
        petugas.appendChild(button);

        var text = option.innerHTML;
        petugas.appendChild(document.createTextNode(text));
        selected.appendChild(petugas);
    }
}

function remove(toDel) {
    var Delete = document.getElementById(toDel);
    var option = Delete.getElementsByTagName('option');
    option[0].style.display = '';
    var select = document.getElementById('spetugas_id');
    var selected = document.getElementById('selected');
    select.appendChild(option[0]);
    selected.removeChild(Delete)
}

function getData(value, toChange) {
    var xmlhttp = new XMLHttpRequest();
    var data;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            lanjut(this.responseText, toChange);
        }
    };
    xmlhttp.open("GET", "/getLocationData/" + value + '/' + toChange, true);
    xmlhttp.send();
}
function createOption(id){
    var selectP = document.getElementById('provinces');
    var selectR = document.getElementById('regencies');
    var selectD = document.getElementById('districts');
    var selectV = document.getElementById('villages');
    var opt = '<option></option>'
    if (id == 'provinces') {
      selectR.innerHTML = opt;
      selectD.innerHTML = opt;
      selectV.innerHTML = opt;
    } else if (id == 'regencies') {
      selectD.innerHTML = opt;
      selectV.innerHTML = opt;
    } else if (id == 'districts') {
      selectV.innerHTML = opt;
    }
    var changed;
    var toChange;
    if (id == 'provinces') {
      toChange = 'regencies';
      changed = selectP;
    } else if (id == 'regencies') {
      toChange = 'districts';
      changed = selectR;
    } else if (id == 'districts') {
      toChange = 'villages';
      changed = selectD;
    }
    getData(changed.value, toChange);
}
function lanjut(input, tochange){
  // var data = input.split("|");
  var json = JSON.parse(input);
  console.log("panjang :" + json.length);
  for (i=0;i<json.length;i++) {
      // json[i] = JSON.parse(data[i]);
      var select = document.getElementById(tochange);
      var option = document.createElement('option');
      option.innerHTML = json[i].name;
      option.value = json[i].id;
      select.appendChild(option);
  }
}

function check(){
    return true;
}
</script>
@endsection
