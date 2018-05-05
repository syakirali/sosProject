<?php

namespace sosProject\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use sosProject\Agenda;
use sosProject\Village;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user);
        $join = $user->leftJoin('positions', 'users.position_id', '=', 'positions.id')
                     ->select('users.*', 'positions.jabatan')
                     ->where('users.id', $user->id)->get();
        // dd($join[0]->name);
        $picture = Storage::url($user->avatar);
        return view('beranda', ['picture' => $picture, 'user' => $join[0]]);
    }

    public function welcome(){
        // $agend = Agenda::all();

        // $agendas = Agenda::whereDate('tanggal', '<', date('Y-m-d'))->get();
        $data = Agenda::join('officers', 'agendas.id', '=', 'officers.agenda_id')
               ->join('users', 'officers.user_id', '=', 'users.id')
               ->select('agendas.*', 'officers.user_id', 'users.name', 'users.no_telp')
               ->whereDate('tanggal', '>', date('Y-m-d'));
        // dd($data);
        $agendas = $data->orderBy('tanggal')->get()->groupBy('id')->toArray();
        $places = $data->whereDate('tanggal', '>', date('Y-m-d'))->select('village_id')->get()->toArray();
        // dd($places);
        $village = [];
        $district = [];
        $regency = [];
        $province = [];
        foreach($places as $piece) {
            $village[$piece['village_id']] = Village::where('id', $piece['village_id'])->first();
            $district[$piece['village_id']] = $village[$piece['village_id']]->district()->first();
            $regency[$piece['village_id']] = $district[$piece['village_id']]->regencie()->first();
            $province[$piece['village_id']] = $regency[$piece['village_id']]->province()->first();
        }
        // dd($province);
        // "ozbt ulpq aejz joqu"
        return view('welcome', [
          'agendas'  => $agendas,
          'village'  => $village,
          'district' => $district,
          'regency'  => $regency,
          'province' => $province
        ]);
    }
}
