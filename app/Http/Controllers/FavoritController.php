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
          'user_id' => 'required',
          'city' => 'required',
      ]
      );
      if(!$validator->fails())
      {

      $model = Favorit::create([
        'user_id' => $request->id,
        'city' =>$request->city,
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

    public function user_auth(){

      return response()->json(Auth::id());
    }
}
