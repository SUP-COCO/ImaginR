<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Sentinel;
use Redirect;
use Response;
use Image;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request){
        if ($request->isMethod('POST')) {
            $rules = [
                'email'         => 'required',
                'password'      => 'required',
            ];

            $data = Input::all();

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                return redirect('login')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $user = [
                    'email' => $data['email'],
                    'password' => $data['password']
                ];

                $result = Sentinel::authenticate($user);

                if ($result) {
                    return Redirect::to('dashboard');
                } else {
                    $data = [
                        'alert' => 'danger',
                        'message' => "L'E-mail et le Mot de passe entré ne corresponde à aucun compte."
                    ];
                    return Redirect::to('login')->with($data);
                }
            }
        } else {
            return view('login');
        }
    }

    public function profil(){
        $user = Sentinel::getUser();
        $stations = DB::table('stations')->get();
        return view('users.profil', ['user' => $user, 'stations' => $stations]);
    }

    public function editProfil(Request $request){
        $user = Sentinel::getUser();
        if ($request->isMethod('POST')) {
            $data = Input::all();

            if ($data['_check'] === 'edit_password') {
                $hasher = Sentinel::getHasher();

                $rules = [
                    'old_password'          => 'required',
                    'password'              => 'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                ];

                $validator = Validator::make($data, $rules);

                if ( $validator->fails()) {
                    return redirect('editProfil#password')
                            ->withErrors($validator)
                            ->withInput();
                } else {
                    if (!$hasher->check($data['old_password'], $user->password)) {
                        $data = [
                            'alert' => 'danger',
                            'message_password' => 'Votre mot de passe est incorrect!'
                        ];

                        return redirect('editProfil#password')->with($data);
                    } else {
                        $credentials = [
                            'password' => $data['password'],
                        ];

                        $user = Sentinel::update($user, $credentials);
                        $data = [
                            'alert' => 'success',
                            'message_password' => 'Votre Mot de passe a été modifier avec succes!'
                        ];

                        return redirect('editProfil#password')->with($data);
                    }
                }
            } elseif($data['_check'] === 'edit_avatar') {
                $image = Input::file('avatarProfil');
                $input = array('avatarProfil' => $image);

                $rules = array(
                    'avatarProfil' => 'image|required'
                );

                $validator = Validator::make($input, $rules);

                if ( $validator->fails()) {
                    return redirect('editProfil')
                            ->withErrors($validator)
                            ->withInput();
                } else {
                    $filename  = uniqid() . '.' . $image->getClientOriginalExtension();

                    $path = public_path('profilPictures/' . $filename);
     
                    Image::make($image->getRealPath())->resize(196, 196)->save($path);
                    $user = Sentinel::getUser();

                    if (!empty($user->avatar)) {
                        $old_path = public_path('profilPictures/' . $user->avatar);
                        if (file_exists($old_path)) {
                            unlink($old_path);
                        }
                    }

                    $user->avatar = $filename;
                    $user->save();

                    if ($user->save()) {
                        $data = [
                            'alert' => 'success',
                            'message_avatar' => 'Image uploaded!'
                        ];
                        return Redirect::to('editProfil')->with($data);
                    } else {
                        $data = [
                            'alert' => 'danger',
                            'message_avatar' => 'Une erreur ses produite'
                        ];
                        return Redirect::to('editProfil')->with($data);
                    }
                }
            }
        } else {
            $user = Sentinel::getUser();
            return view('users.edit', ['user' => $user]);
        }
    }

    public function register(Request $request){
        if ($request->isMethod('POST')) {
            $rules = [
                'email'         => 'unique:users|required|min:4|max:254|email',
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'password'      => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'avatarProfil'  => 'required|image'
            ];

            $data = Input::all();
            $image = Input::file('avatarProfil');
            $data['image'] = $image;

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                return redirect('register')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $filename  = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = public_path('profilPictures/' . $filename);
                Image::make($image->getRealPath())->resize(196, 196)->save($path);

                $data['avatar'] = $filename;

                $user = [
                    'email'         => $data['email'],
                    'first_name'    => $data['first_name'],
                    'last_name'     => $data['last_name'],
                    'password'      => $data['password'],
                    'avatar'        => $data['avatar']
                ];

                $result = Sentinel::registerAndActivate($user);

                if ($result) {
                    Sentinel::authenticate(['email' => $data['email'], 'password' => $data['password']]);
                    return Redirect::to('dashboard');
                }
            }
        } else {
            return view('register');
        }
    }

    public function logout(){
        Sentinel::logout();
        $data = [
            'alert' => 'success',
            'message' => "Merci d’être passé ! Nous espérons vous revoir bientôt."
        ];
        return Redirect::to('login')->with($data);       
    }

    public function abonnement(){
        $user = Sentinel::getUser();
        return view('users.abonnement', ['user' => $user]);
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
