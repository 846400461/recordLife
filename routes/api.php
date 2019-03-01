<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/',function(){
//     return 'hello api';
// });

// Route::get('register','api\registerController@register');
// Route::post('register','api\registerController@create');

// Route::post('login','api\loginController@vertify');
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
    $api->get('version', function() {
        return response('this is version v1');
    });

    $api->get('register','App\Http\Controllers\api\registerController@register');
    $api->post('register','App\Http\Controllers\api\registerController@create');
    $api->post('login','App\Http\Controllers\api\loginController@vertify');
    $api->get('test','App\Http\Controllers\api\testController@test');

    $api->group(['middleware' => 'my.api.auth'], function ($api) {
        $api->get('user/info', 'App\Http\Controllers\api\userInfoController@userInfo');
        $api->post('user/info', 'App\Http\Controllers\api\userInfoController@updateUserInfo');
        $api->post('user/dateinfo','App\Http\Controllers\api\dateInfoController@submitDateInfo');
        $api->post('user/dateinfo/background/{dateId}','App\Http\Controllers\api\dateInfoController@uploadBackground');
        $api->get('user/dateinfo','App\Http\Controllers\api\dateInfoController@dateinfo');
    });

});

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});

