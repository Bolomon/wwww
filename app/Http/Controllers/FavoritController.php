<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorit;
use Auth;

class FavoritController extends Controller
{


    public function create(Request $request){
      $validator = validator($request->all(),
      [
          'city' => 'required',

      ]
      );
      if(!$validator->fails())
      {

      $model = Favorit::create([
        'city' =>$request->city,
        'user_id' => 1,

      ]);
      if($model){
          return response()->json($model)
              ->setStatusCode('200');
      }

    }
    return response()
            ->json($validator->errors())
            ->setStatusCode(400, 'Bad Request');


    }


    public function get_favorit(){
      return response()->json(Favorit::get())
          ->setStatusCode('200');
    }


    public function user_auth(){

      return response()->json(Auth::id());
    }
}
