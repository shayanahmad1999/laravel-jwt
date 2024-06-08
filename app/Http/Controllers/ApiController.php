<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    protected function successResponse($data, $message = "success", $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    protected function errorResponse($errors, $message = "error", $status = 422)
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}