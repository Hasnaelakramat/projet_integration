<?php
 

 namespace App\Traits;

 trait httpresponses
 {
    protected function success($data,$message=null,$code=200)
    {
        return response()->json([
            'statut'=>'the request was successful',
            'message'=> $message,
            'data'=>$data
        ],$code);

    }

    protected function error($data,$message=null,$code=404)
    {
        return response()->json([
            'statut'=>'an ERROR HAS OCCURED',
            'message'=> $message,
            'data'=>$data
        ],$code);

    }
 }