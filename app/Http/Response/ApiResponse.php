<?php
namespace App\Http\Response;

class ApiResponse
{
    public function successResponse($data = [], $message, $code = 200)
    {

        return response()->json([
            "status" => 'success',
            "message" => $message,
            "code" => $code,
            "data" => $data
        ]);

    }
    public function errorResponse($message, $code = 500)
    {

        return response()->json([
            "status" => "fail",
            "message" => $message,
            "code" => $code,

        ]);

    }
}


?>