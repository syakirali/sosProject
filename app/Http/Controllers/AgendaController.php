<?php

namespace sosProject\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use sosProject\Agenda;
use sosProject\Province;
use sosProject\User;
use sosProject\Report;
use sosProject\Officer;
use sosProject\District;
use sosProject\Village;
use sosProject\Regencie;

class AgendaController extends Controller
{
    public function tampil(){
        $user = Auth::user();
        if ($user->position_id != 1) {
          $data = User::find($user->id)->agendas();
        } else {
          $data = Agenda::join('officers', 'agendas.id', '=', 'officers.agenda_id')
                 ->join('users', 'officers.user_id', '=', 'users.id')
                 ->select('agendas.*', 'officers.user_id', 'users.name', 'users.no_telp');
        }

        // dd($data->get());
        $agendas = $data->orderBy('tanggal')->get();
        $reports = Report::all();
        $a_villages = $data->select('village_id')->get()->toArray();
        $villages = [];
        $districts = [];
        $regencies = [];
        $provinces = [];
        // dd($a_villages[0]['village_id']);
        // dd(Village::find($a_villages[0]['village_id'])->get());
        // dd($a_villages[0]->village_id);
        foreach($a_villages as $piece) {
            $villages[$piece['village_id']] = Village::where('id', $piece['village_id'])->first();
            // dd($villages[$piece['village_id']]);
            $districts[$piece['village_id']] = $villages[$piece['village_id']]->district()->first();
            $regencies[$piece['village_id']] = $districts[$piece['village_id']]->regencie()->first();
            $provinces[$piece['village_id']] = $regencies[$piece['village_id']]->province()->first();
        }
        foreach ($agendas as $agenda) {
            if (count($reports->where('agenda_id', $agenda->id)) > 0) {
                $agenda->status = true;
            } else {
              $agenda->status = false;
            }
        }
        // dd($agendas->groupBy('id'));
        return view('agendaTampil', [
          "agendas" => $agendas->groupBy('id'),
          "provinces" => $provinces,
          "regencies" => $regencies,
          "districts" => $districts,
          "villages" => $villages,
        ]);
    }

    public function tampilForm(){
        $provinces = Province::all();
        $users = User::where('position_id', '!=', '1')->get();
        return view('agendaForm', ["provices" => $provinces,"users" => $users]);
    }

    public function tambah(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_agenda' => 'required|string|max:100',
            'instansi' => 'required|string|max:50',
            'provinces' => 'required|numeric',
            'regencies' => 'required|numeric',
            'districts' => 'required|numeric',
            'villages' => 'required|numeric',
            'tanggal' => 'required|date',
            'alamat' => 'required|string|max:100',
            'petugas_id' => 'required',
        ]);

        if ($validator->fails()) {
            // dd($validator);
            return redirect()->route('agenda form')
                        ->withErrors($validator)
                        ->withInput();
        }

        $agenda = new Agenda;
        $agenda->tanggal = $request->tanggal;
        $agenda->nama_agenda = $request->nama_agenda;
        $agenda->village_id = $request->villages;
        $agenda->alamat = $request->alamat;
        $agenda->instansi = $request->instansi;
        $agenda->save();
        foreach($request->petugas_id as $user_id) {
            $officer = new Officer;
            $officer->agenda_id = $agenda->id;
            $officer->user_id = $user_id;
            $officer->save();
        }
        return redirect()->route('agenda form');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_agenda' => 'required|string|max:100',
            'instansi' => 'required|string|max:50',
            'provinces' => 'required|numeric',
            'regencies' => 'required|numeric',
            'districts' => 'required|numeric',
            'villages' => 'required|numeric',
            'tanggal' => 'required|date',
            'alamat' => 'required|string|max:100',
            'nama[]' => 'required|string',
        ]);
    }

    public function hapus($id){
        // dd($id);
        Agenda::destroy($id);
        return redirect()->route('agenda tampil');
    }
}
