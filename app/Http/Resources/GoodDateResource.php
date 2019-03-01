<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Log;

class GoodDateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'userId'=>$this->userId,
            'message'=>$this->message,
            'type'=>$this->type,
            'gooodDate'=>$this->goodDate,
            $this->mergeWhen($this->hasBackgroundFile(),$this->getBackgroundFile()),


        ];
    }

    public function hasBackgroundFile()
    {
        if(empty($this->fileName)||$this->fileName=='')
            return false;

        return true;
    }

    public function getBackgroundFile()
    {
        if(!$this->hasBackgroundFile())
            return [];
        $fileName=$this->fileName;
        $file=[];

        while (strlen($fileName)>0) {
            $temp=str_after($fileName,'??');
            $temp=str_before($temp,'||');
            $fileInfo=[
                'name'=>str_before($fileName,'??'),
                'fileName'=>$temp,
            ];

            $file[]=$fileInfo;
            $fileName=str_after($fileName,'||');
        }
        return compact('file');
    }
}


/*

file:[
    {
    "name":"test.jpeg",
    "fileName":"sdfedfsdfsdf.jpeg"
    },
    {
    "name":"test.jpeg",
    "fileName":"sd11fedfsdfsdf.jpeg"
    },

]

 */
