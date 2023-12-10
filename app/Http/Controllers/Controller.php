<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected static function successResponse($data, $code = 200) {
        return response()->json([
            'success' => true,
            'response' => $data,
        ], $code);
    }

    protected function failureResponse($data, $code = 409) {
        return response()->json([
            'success' => false,
            'response' => $data,
        ], $code);
     }

    private function genericResponse($data, $code = 200) {
        return response()->json($data, $code);
    }


}
