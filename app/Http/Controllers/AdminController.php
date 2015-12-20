<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use DB;
use Validator;
use App\Station;
use App\User;
use Input;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function dashboard()
    // {
    //     $user = Sentinel::getUser();
    //     return view('profil')->with($user);
    // }

    public function index(){
        $user = Sentinel::getUser();
        $users = DB::table('users')->get();
        $stations = DB::table('stations')->get();
        return view('admin.dashboard', ['user' => $user, 'users' => $users, 'stations' => $stations]);
    }

    public function users(){
        $user = Sentinel::getUser();
        $users = User::all();

        foreach ($users as $key => $user) {
            $user['card'] = $user->card;
            $user['checkCard'] = $user['card']->checkCard();
        }

        return view('admin.users', ['user' => $user, 'users' => $users]);
    }

    public function stations(){
        $user = Sentinel::getUser();
        $stations = DB::table('stations')->get();
        foreach ($stations as $key => $station) {
            $station->LatLng = json_decode($station->location);
        }
        return view('admin.stations', ['user' => $user, 'stations' => $stations]);
    }

    public function createStation(Request $request){
        if ($request->isMethod('POST')) {
            $data = Input::all();

            $rules = [
                'station_name'  => 'required',
                'latitude'      => 'required',
                'longitude'     => 'required',
                'description'   => 'required'
            ];

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                return redirect('admin/stations')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $location = ['lat' => $data['latitude'], 'lng' => $data['longitude']];
                $location = json_encode($location);

                $key = md5(microtime().rand());

                $station = new Station();
                $station->name = $data['station_name'];
                $station->description = $data['description'];
                $station->location = $location;
                $station->key = $key;
                $station->valid = 1;

                if ($station->save()) {
                    $data = [
                        'alert' => 'success',
                        'message_create' => 'Votre Station a été créer!'
                    ];
                    return redirect('admin/stations')->with($data);
                }
            }

        } else {
            return redirect('admin/stations');
        }
    }

    public function updateStation(Request $request){
        if ($request->isMethod('POST')) {
            $data = Input::all();

            $rules = [
                'update_name'           => 'required',
                'update_id'             => 'required',
                'update_description'    => 'required',
                'update_latitude'       => 'required',
                'update_longitude'      => 'required'
            ];

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                return redirect('admin/stations')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $location = ['lat' => $data['update_latitude'], 'lng' => $data['update_longitude']];
                $location = json_encode($location);

                $station = Station::find($data['update_id']);
                $station->name = $data['update_name'];
                $station->description = $data['update_description'];
                $station->location = $location;

                if ($station->save()) {
                    $data = [
                        'alert' => 'success',
                        'message_update' => 'Votre Station a été modifier!'
                    ];
                    return redirect('admin/stations')->with($data);
                }
            }

        } else {
            return redirect('admin/stations');
        }
    }

    public function deleteStation(Request $request){
        if ($request->isMethod('POST')) {
            $data = Input::all();

            $rules = [
                'update_id'   => 'required',
            ];

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                return redirect('admin/stations')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $station = Station::find($data['update_id']);

                if ($station->delete()) {
                    $data = [
                        'alert' => 'success',
                        'message_delete' => 'Votre Station a été supprimer!'
                    ];
                    return redirect('admin/stations')->with($data);
                }
            }

        } else {
            return redirect('admin/stations');
        }
    }

    public function createUser(Request $request) {
        if ($request->isMethod('POST')) {
            $data = Input::all();

            $rules = [
                'email'                 => 'unique:users|required|min:4|max:254|email',
                'first_name'            => 'required|max:255',
                'last_name'             => 'required|max:255',
                'password'              => 'required|min:6|confirmed',
                'password_confirmation' => 'required'
            ];

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                return redirect('admin/users')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $user = [
                    'email'         => $data['email'],
                    'first_name'    => $data['first_name'],
                    'last_name'     => $data['last_name'],
                    'password'      => $data['password']
                ];

                $result = Sentinel::registerAndActivate($user);

                if ($result) {
                    $data = [
                        'alert' => 'success',
                        'message_create' => "L'Utilisateur a été créer!"
                    ];
                    return redirect('admin/users')->with($data);
                }
            }

        } else {
            return redirect('admin/users');
        }
    }
}