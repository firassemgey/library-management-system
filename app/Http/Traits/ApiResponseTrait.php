<?php

namespace App\Http\Traits;


trait ApiResponseTrait
{
    public function apiResponse($status,$data,$message, $statusCode){

        $array = [
            'status'=>$status,
            'message'=>$message,
            'data' =>$data,
            'statusCode' =>$statusCode,
        ];

        return response()->json($array);
    }


}