<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use App\User;
use App\Offre;
use Validator;
use Input;

class AboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function abonnement(){
        $user = Sentinel::getUser();
        $card = User::find($user->id)->card;
        $offres = Offre::all();
        if ($card) {
            $user['checkCard'] = $card->checkCard();
        }

        return view('users.abonnement', ['user' => $user, 'card' => $card, 'offres' => $offres]);
    }

    public function validAbo(Request $request){
        if ($request->isMethod('POST')) {
            $data = Input::all();

            $rules = [
                'id_offre' => 'required'
            ];

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                return redirect('abonnement')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $offre = Offre::where('id', $data['id_offre'])->first();

                if($offre){
                    $test = PayPal::apiContext(config('paypal.Account.ClientId'));
                    return $test;
                }
            }
        }
    }
}
