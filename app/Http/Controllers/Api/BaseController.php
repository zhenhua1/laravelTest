<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function success($data=[],$message='',$statusCode=200)
    {
        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'statusCode'=>$statusCode
        ]);
    }

    public function error($message='',$statusCode=-200,$data=[])
    {
        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'statusCode'=>$statusCode
        ]);
    }

    /**
     * validate check
     * @param $validator
     * @return string|null
     */
    public function validateCheck($validator)
    {
        if($validator->fails()){
            $errors=$validator->getMessageBag()->getMessages();
            $msg='';
            foreach($errors as $error){
                $msg.=$error[0].',';
            }
            return rtrim($msg,',');
        }
        return null;
    }
}
