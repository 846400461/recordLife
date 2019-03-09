<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GoodDate;
use Carbon\Carbon;
use App\Http\Resources\GoodDateResource;
use Illuminate\Support\Facades\Storage;
use Log;

class dateInfoController extends BaseController
{
    public function submitDateInfo(Request $request)
    {
        if(!$request->has(['message','type','goodDate']))
            return response()->json(['errorCode'=>1<<7],403);

        $goodDate=$request->input('goodDate');

        if(!Carbon::hasFormat($goodDate,'Y-m-d H:i:s.u'))
             return response()->json(['errorCode'=>1<<7],403);

        $dateTime=new GoodDate;
        $user=$request->user('api');
        $dateTime->userId=$user->id;
        $dateTime->message=$request->input('message');
        $dateTime->type=intval($request->input('type'));
        $dateTime->goodDate=new Carbon($goodDate);
        $dateTime->save();

        return $dateTime;
    }

    public function uploadBackground($dateId,Request $request)
    {
        if(!$request->hasFile('background'))
            return response()->json(['errorCode'=>1<<8],403);

        $goodDate=null;
        $goodDate=GoodDate::find($dateId);
        if(empty($goodDate))
            return response()->json(['errorCode'=>1<<4],403);

        $file=$request->file('background');
        $fileName=$file->getClientOriginalName();

        $path=strval($request->user('api')->id)."/$dateId/dateFile";
        $path=$file->store($path);
        $path=str_replace_first(strval($request->user('api')->id).'/','',$path);
        if(empty($goodDate->fileName)||$goodDate->fileName=='')
            $goodDate->fileName=$fileName.'??'.$path.'||';
        else
            $goodDate->fileName=$goodDate->fileName.$fileName.'??'.$path.'||';
        $goodDate->save();

        return response()->noContent(200);
    }

    public function dateinfo(Request $request)
    {
        $dates=GoodDate::where('UserId','=',$request->user('api')->id)->paginate(15);

        return GoodDateResource::collection($dates);
    }

    public function downloadImage(Request $request)
    {
        $fileName=strval($request->user('api')->id).'/'.$request->input('fileName');
        $files=Storage::allFiles(strval($request->user('api')->id));
        if(!in_array($fileName,$files))
        {
            return response()->json(['errorCode'=>1<<9],403);
        }

        return Storage::download($fileName);
    }
}
