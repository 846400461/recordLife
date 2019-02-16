<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class userInfoController extends BaseController
{
    public function userInfo(Request $request)
    {
        return new UserResource($request->user('api'));
    }

    public function updateUserInfo(Request $request)
    {
        $user=$request->user('api');
        $name = $request->input('name');
        if(empty($name))
            return response()->json(['errorCode'=>1<<7],403);
        $user->name=$name;
        $user->save();

        return new UserResource($user);
    }
}
