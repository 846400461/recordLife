<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;

class testController extends BaseController
{
    public function test()
    {
        return User::paginate(2);

    }
}
