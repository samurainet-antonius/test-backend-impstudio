<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(Request $request) {

        $reqData = $request->all();

        $validate = Validator::make($reqData,[
            'username' => 'required|min:2',
            'password' => 'required|min:5'
        ],[
            'required' => 'The :attribute field is required.',
            'min' => 'The :attribute should have minimum :min characters.'
        ]);

        if($validate->fails()){
            return response()->json([
                'code' => 400,
                'status' => 'BAD_REQUEST',
                'errors' => $validate->errors()
            ], 400);
        }

        $user = User::where('username', $reqData['username'])->first();

        if(!empty($user) || isset($user)) {
            return response()->json([
                'code' => 409,
                'status' => 'CONFLICT',
                'errors' => [
                    'username' => 'The username already exists'
                ]
            ], 409);
        }

        try {

            $reqData['password'] = Hash::make($reqData['password']);
            $reqData['created_at'] = date("Y-m-d H:i:s");
            User::insert($reqData);

            unset($reqData['password']);

            return response()->json([
                'code' => 201,
                'status' => 'CREATED',
                'data' => $reqData
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'code' => 500,
                'status' => 'INTERNAL_SERVER_ERROR',
                'message' => 'An error occurred on the server.'
            ], 500);
        }
    }

    public function login(Request $request) {

        $reqData = $request->all();

        $validate = Validator::make($reqData,[
            'username' => 'required|min:2',
            'password' => 'required|min:5'
        ],[
            'required' => 'The :attribute field is required.',
            'min' => 'The :attribute should have minimum :min characters.'
        ]);

        if($validate->fails()){
            return response()->json([
                'code' => 400,
                'status' => 'BAD_REQUEST',
                'errors' => $validate->errors()
            ], 400);
        }

        try {

            if (! $token = auth()->attempt($validate->validate())) {
                return response()->json([
                    'code' => 401,
                    'status' => 'UNAUTHORIZED',
                    'message' => 'username and password do not match.'
                ], 401);
            }

            return $this->createNewToken($token);

        } catch (Exception $e) {

            return response()->json([
                'code' => 500,
                'status' => 'INTERNAL_SERVER_ERROR',
                'message' => 'An error occurred on the server.'
            ], 500);
        }
    }

    protected function createNewToken($token){

        return response()->json([
            'code' => 201,
            'status' => 'CREATED',
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        ], 201);
    }
}
