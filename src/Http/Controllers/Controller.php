<?php

namespace Ferasalhallak\SmartLaravel\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function SuccessResponse($data = [])
    {
        return response()->json(['status' => 'success', 'data' =>  $data]);
    }

    public function SuccessResponseIndex($data , $name)
    {
        return response()->json(['status' => 'success', $name =>  $data]);
    }

    public function ErrorResponse($message)
    {
        return response()->json(['status' => 'error', 'message' =>  $message], 400);
    }
}
