<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AppController extends Controller
{
    //
    /**
     * sample api responce
     *
     * @return Response
     */
    public function echo1()
    {   
        
        $res['status'] = "OK";
        $res['message'] = "No problem";
        
        return \Response::json($res);
    }
}
