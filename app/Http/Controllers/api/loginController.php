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
            return 'no json';

        $userInfo=$request->json()->all();
        $erroCode=$this->validateJsonData($userInfo);

        if($erroCode>1)
        {
            return compact('erroCode');
        }
        $erroCode=0;

        if(!User::where('email',$userInfo['email'])->exists())
        {
            $erroCode|=1<<4;
            return compact('erroCode');
        }
        $user=User::where('email',$userInfo['email']);
        if(Hash::check($userInfo['password'],$user->value('password')))
        {
            $api_token=str_random(64)." ".strval($user->value('id'));
            User::where('id',$user->value('id'))->update(['api_token'=>$api_token]);
            return compact('erroCode','api_token');
        }
        else
        {
            $erroCode|=1<<5;
            return compact('erroCode');
        }
    }

}
