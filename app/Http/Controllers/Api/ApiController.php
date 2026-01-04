<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function success(?string $message, $data = []){
        if(is_null($message)) 
            $message = "تمت العملية بنجاح";

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    protected function failed(?string $message, $data = [], $error_code = 500){
        if(is_null($message))
            $message = "فشلت العملية";

        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
            // 'errors' => $errors
        ], $error_code);
    }
}
