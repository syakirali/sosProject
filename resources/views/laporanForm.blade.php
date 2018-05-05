@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Buat Laporan</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('laporan tambah') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('id_agenda') ? ' has-error' : '' }}">
                            <label for="id_agenda" class="col-md-4 control-label">Agenda</label>

                            <div class="col-md-6">
                                <select class="form-control" name="id_agenda">
                                    @foreach($agendas as $agenda)
                                    <option value="{{ $agenda->id }}" {{ $selected == $agenda->id ? 'selected' : '' }}>{{ $agenda->nama_agenda }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_agenda'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_agenda') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('uraian') ? ' has-error' : '' }}">
                            <label for="uraian" class="col-md-4 control-label">Uraian</label>
                            <div class="col-md-6">
                              <textarea id="uraian" name="uraian" class="form-control" required autofocus>{{ old('uraian') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kendala') ? ' has-error' : '' }}">
                            <label for="kendala" class="col-md-4 control-label">Kendala</label>
                            <div class="col-md-6">
                              <textarea id="kendala" name="kendala" class="form-control" required>{{ old('kendala') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photos') ? ' has-error' : '' }}">
                            <label for="photos" class="col-md-4 control-label">Dokumentasi Foto</label>

                            <div class="col-md-6">
                                <input id="photos" type="file" class="" name="photos[]" value="{{ old('photos') }}" accept="image/*" multiple required>

                                @if ($errors->has('photos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photos') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dokumen') ? ' has-error' : '' }}">
                            <label for="dokumen" class="col-md-4 control-label">Dokumen</label>

                            <div class="col-md-6">
                                <input id="dokumen" type="file" class="" name="dokumen" value="{{ old('dokumen') }}" accept="application/msword" required>

                                @if ($errors->has('dokumen'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dokumen') }}</strong>
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
@endsection
