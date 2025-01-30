<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends BaseController
{
    /**
     * Register a User.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['user'] = $user;

        return $this->sendResponse($success, 'User registered successfully.');
    }

    /**
     * Login a user.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return $this->sendError('Unauthorized.', ['error' => 'Invalid credentials']);
        }

        return $this->sendResponse($this->respondWithToken($token), 'User login successful.');
    }

    /**
     * Get user profile.
     */
    public function profile()
    {
        return $this->sendResponse(auth()->user(), 'User profile retrieved.');
    }

    /**
     * Logout a user.
     */
    public function logout()
    {
        auth()->logout();
        return $this->sendResponse([], 'User logged out.');
    }

    /**
     * Refresh a JWT token.
     */
    public function refresh()
    {
        return $this->sendResponse($this->respondWithToken(auth()->refresh()), 'Token refreshed.');
    }

    /**
     * Return token structure.
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
