<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class loginController extends BaseController
{
    //
    use validateJson;
    public function vertify(Request $request)
    {
        if(!$request->isJson())
            return response()->json(['erroCode'=>1<<6],400);

        $userInfo=$request->json()->all();
        $erroCode=$this->validateJsonData($userInfo);

        if($erroCode>1)
        {
            return response()->json(compact('erroCode'),403);
        }
        $erroCode=0;

        if(!User::where('email',$userInfo['email'])->exists())
        {
            $erroCode|=1<<4;
            return response()->json(compact('erroCode'),403);
        }
        $user=User::where('email',$userInfo['email']);
        if(Hash::check($userInfo['password'],$user->value('password')))
        {
            $api_token=str_random(64)." ".strval($user->value('id'));
            User::where('id',$user->value('id'))->update(['api_token'=>$api_token]);
            return response()->json(compact('api_token'),200);
        }
        else
        {
            $erroCode|=1<<5;
            return response()->json(compact('erroCode'),403);
        }
    }

}
