<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class registerController extends BaseController
{
    //
    use validateJson;
    public function register()
    {
        $arry=['jack'=>'asdfs','adfsa'=>'kldkl'];
        return $arry;
    }

    public function create(Request $request)
    {
        if($request->isJson())
        {
            $userInfo=$request->json()->all();
            $erroCode=$this->validateJsonData($userInfo);
            Log::info($erroCode);
            if(!$erroCode)
            {
                if(User::where('email',$userInfo['email'])->exists())
                {
                    $erroCode|=1<<3;
                    return compact("erroCode");
                }
                User::create([
                    'name' => $userInfo['name'],
                    'email' => $userInfo['email'],
                    'password' => Hash::make($userInfo['password']),
                    'api_token'=> str_random(64),
                    ]);
                return compact("erroCode");
            }
            else
            {
                return compact("erroCode");
            }

        }
        else
            return 'no json';
    }


}
