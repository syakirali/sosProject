<?php

namespace sosProject\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use sosProject\Report;
// use sosProject\Agenda;

class LaporanController extends Controller
{
    public function tampil(){
        return view('laporanTampil', ['reports' => Report::all()]);
    }

    public function tampilForm(){
        $user = Auth::user();
        $userAgendas = $user->agendas()->whereDate('tanggal', '<', date('Y-m-d'))->get();
        // $userAgendas = $user->agendas()->get();
        $agendas = [];
        $i = 0;
        foreach ($userAgendas as $userAgenda) {
            if(count($userAgenda->report()->get()) == 0) {
                $agendas[$i++] = $userAgenda;
            }
        }
        return view('laporanForm', ['agendas' => $agendas, 'selected' => '']);
    }

    public function tampilForm_($id_agenda){
        $user = Auth::user();
        $userAgendas = $user->agendas()->whereDate('tanggal', '<', date('Y-m-d'))->get();
        // $userAgendas = $user->agendas()->get();
        $agendas = [];
        $i = 0;
        foreach ($userAgendas as $userAgenda) {
            if(count($userAgenda->report()->get()) == 0) {
                $agendas[$i++] = $userAgenda;
            }
        }
        // dd($id_agenda);
        return view('laporanForm', ['agendas' => $agendas, 'selected' => $id_agenda]);
    }

    public function tambah(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'id_agenda' => 'required|numeric',
            'uraian'    => 'required|string',
            'kendala'   => 'required|string',
            'photos'    => 'required',
            'dokumen'   => 'required',
        ]);

        if ($validator->fails()) {
            // dd($validator);
            return redirect()->route('laporan form')
                             ->withErrors($validator)
                             ->withInput();
        }
        $photos = $request->file('photos');
        $photos_path = '';
        foreach ($photos as $photo) {
            $photos_path .= Storage::putFile('public/agendas/photos/'.$request->id_agenda, $photo);
            $photos_path .= '||';
        }
        $dokumen = $request->file('dokumen');
        $document_path = Storage::putFile('public/agendas/documents/'.$request->id_agenda, $dokumen);

        $laporan = new Report;
        $laporan->agenda_id = $request->id_agenda;
        $laporan->uraian = $request->uraian;
        $laporan->kendala = $request->kendala;
        $laporan->photos_path = $photos_path;
        $laporan->document_path = $document_path;
        $laporan->save();
        return redirect()->route('laporan form');
    }

    public function hapus($id){
        $report = Report::where('id', $id)->get();
        if (count($report) == 1) {
          $path = explode('/', $report[0]->document_path);
          Storage::deleteDirectory('public/agendas/documents/'.$path[2]);
          Storage::deleteDirectory('public/agendas/photos/'.$path[2]);
          $report[0]->delete();
        }
        return redirect()->route('laporan tampil');
    }

    public function detail($id){
        $laporan = Report::where('id', $id)->get()->first();
        $join = $laporan->leftJoin('agendas', 'reports.agenda_id', '=', 'agendas.id')
                        ->select('agendas.*', 'reports.*')->get()->all();
        $photos_path = explode('||', $join[0]->photos_path);
        array_pop($photos_path);
        return view('laporanDetail', ['laporan' => $join[0], 'photos_path' => $photos_path]);
    }
}
