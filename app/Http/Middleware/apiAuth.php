<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class apiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $errorCode=$this->authenticate($request);
        if($errorCode!=0)
        {
            return compact('errorCode');
        }
        return $next($request);


    }

    public function authenticate($request)
    {
        $apiToken=$request->header('api-token');
        if(empty($apiToken))
            return 1<<6;
        $useStr=str_after($apiToken,' ');
        $useId=intval($useStr);

        $user=Auth::guard('api')->getProvider()->retrieveById($useId);
        if(empty($user))
        {
            return 1<<4;
        }
        $token=$user->api_token;
        if($token!=$apiToken)
        {
            return 1<<4;
        }
        Auth::guard('api')->setUser($user);
        return 0;
    }
}
