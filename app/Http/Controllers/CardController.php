<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Sentinel;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Card;
use App\Station;
use App\Validation;
use Response;

class CardController extends Controller
{

    public function ValidCard(Request $request){
        $data = Input::all();

        $rules = [
            'user_id'       => 'required',
            'api_key'       => 'required'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            return Response::json(['card'=> $validator]);
        } else {
            $card = User::find($data['user_id'])->card;

            if ($card) {
                $valid = $card->checkCard();
                if ($valid) {
                    $station = Station::where('key', $data['api_key'])->first();

                    if ($station){
                        $valid = $station->checkValid();

                        if ($valid) {
                            $validation = new Validation();
                            $validation->date = date('Y-m-d H:i:s');
                            $validation->user_id = $data['user_id'];
                            $validation->station_id = $station->id;

                            if ($validation->save()) {
                                return Response::json(['success'=> 'Votre carte a été validé.']);
                            } else {
                                return Response::json(['error'=> 'Il semblerait qu\'une erreur ce soit produite.']);
                            }
                        } else {
                            return Response::json(['error'=> 'ERREUR!']);
                        }
                        
                    } else {
                        return Response::json(['error'=> 'ERREUR! Vous ne pouvez pas executer cette requete.']);
                    }
                } else {
                    return Response::json(['error'=> 'Votre abonnements est expirer ou pas encore commencez.']);
                }
            } else {
                return Response::json(['error'=> 'Il semblerait que vous ne possediez pas d\'abonnements.']);
            }
        }
    }
}