<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use DB;
use Validator;
use App\Station;
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
        return view('admin.dashboard', ['user' => $user]);
    }

    public function users(){
        $user = Sentinel::getUser();
        $users = DB::table('users')->get();
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

                $station = new Station();
                $station->name = $data['station_name'];
                $station->description = $data['description'];
                $station->location = $location;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
