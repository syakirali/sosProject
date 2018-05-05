<?php

namespace sosProject\Http\Controllers;

use Illuminate\Http\Request;
use sosProject\Province;
use sosProject\Regencie;
use sosProject\District;
use sosProject\Village;

class GetLocationData extends Controller
{
    public function index($id, $type){
        switch ($type) {
          // case 'provinces':
          //   // return Province::all();
          //   return response()->json(Province::all()->toarray());
          //   break;
          case 'regencies':
            $data = Regencie::where('province_id', $id)->get();
            // return $this->to_JSON_format($data);
            return response()->json($data->toarray());
            break;
          case 'districts':
            $data = District::where('regency_id', $id)->get();
            // dd($data->toarray());
            // return $this->to_JSON_format($data);
            return response()->json($data->toarray());
            break;
          case 'villages':
            $data = Village::where('district_id', $id)->get();
            // return $this->to_JSON_format($data);
            return response()->json($data->toarray());
            break;
          default:
            // $result = json_encode(Province::all());
            // return $result;
            // break;
            return response()->json(Province::all()->toarray());
            break;
        }
    }

    private function to_JSON_format($data_) {
        $i = 0;
        foreach($data_ as $piece) {
            $result[$i++] = '{"id":"' . $piece->id . '","name":"' . $piece->name . '"}';
        }
        return implode('|', $result);
    }
}
