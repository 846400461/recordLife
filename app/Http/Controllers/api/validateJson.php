<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2019-02-07 16:44:06
 * @version $Id$
 */
namespace App\Http\Controllers\api;

trait validateJson  {

    public function validateJsonData($array)
    {
        $erroCode=0;
        if(empty($array['name'])||!is_string($array['name']))
        {
            $erroCode|=1<<0;
        }

        if(empty($array['email'])||!is_string($array['email']))
        {
            $erroCode|=1<<1;
        }
        if(empty($array['password'])||!is_string($array['password']))
        {
            $erroCode|=1<<2;
        }
        return $erroCode;
    }


    public function validateLoginJsonData($array)
    {
        $erroCode=0;
        if(empty($array['name'])||!is_string($array['name']))
        {
            $erroCode|=1<<0;
        }

        if(empty($array['email'])||!is_string($array['email']))
        {
            $erroCode|=1<<1;
        }
        if(empty($array['password'])||!is_string($array['password']))
        {
            $erroCode|=1<<2;
        }
        return $erroCode;
    }
}
