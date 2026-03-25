<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        $user = auth('api')->user();
        $employeeId = Employee::where('user_id', $user->id)->value('id');

        return response()->json([
            'employee_id' => $employeeId,
            'user' => $user,
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());
        return $this->respondWithToken($newToken);
    }

    protected function respondWithToken($token)
    {
        $user = auth('api')->user();
        $employeeId = Employee::where('user_id', $user->id)->value('id');

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'employee_id' => $employeeId,
            'user' => $user,
        ]);
    }

}
