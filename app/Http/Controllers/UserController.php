<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request) {

        try {

            $limit = $request->limit ? $request->limit : 20;

            $userData = User::orderBy('created_at', 'DESC')->paginate($limit);

            if(empty($userData) || !isset($userData)) {

                return response()->json([
                    'code' => 404,
                    'status' => 'NOT_FOUND',
                    'message' => 'User list not found.'
                ], 404);
            }


            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'data' => $userData
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'code' => 500,
                'status' => 'INTERNAL_SERVER_ERROR',
                'message' => 'An error occurred on the server.'
            ], 500);
        }


    }
}
