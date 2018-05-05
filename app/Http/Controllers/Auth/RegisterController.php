<?php

namespace sosProject\Http\Controllers\Auth;

use sosProject\User;
use sosProject\Position;
use sosProject\District;
use sosProject\Officer;
use sosProject\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $positions = Position::all();
        $user = Auth::user();
        if ($user->position_id != 1) {
            return redirect()->route('beranda');
        }
        return view('auth.register', ["positions" => $positions]);
    }

    public function tampil(){
        $users = Auth::user()->leftJoin('positions', 'users.position_id', '=','positions.id')
                             ->select('users.*', 'positions.jabatan')
                             ->get();
        $user = $users->all();
        return view('petugasTampil', ['users' => $users]);
    }

    public function hapus($id) {
        $officer = Officer::where('user_id', $id);
        $officer->delete();
        User::destroy($id);
        return redirect()->route('petugas tampil');
    }

    public function uploadPP(Request $request){
        $user = Auth::user();
        $avatar = $request->file('profile');
        Storage::deleteDirectory('public/avatars/'.$user->id);
        $picture_path = Storage::putFile('public/avatars/'.$user->id, $avatar);
        $user->avatar = $picture_path;
        $user->save();
        return redirect()->route('beranda');
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function guard()
    {
        return Auth::guard('web');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string|max:1',
            'position_id' => 'required|numeric|max:2',
            'tgl_lahir' => 'required|date',
            'no_telp' => 'required|numeric',
            'tempat_lahir' => 'required|string|max:20',
            'alamat' => 'required|string|max:100',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'position_id' => $data['position_id'],
            'tgl_lahir' => $data['tgl_lahir'],
            'tempat_lahir' => $data['tempat_lahir'],
            'no_telp' => $data['no_telp'],
            'alamat' => $data['alamat'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
