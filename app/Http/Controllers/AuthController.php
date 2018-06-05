<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Log, App\User, JWTAuth, Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    /**
     * Register function to register user.
     *
     * @return json
     */
    public function register()
    {
        $credentials = request()->input();

        $validation = Validator::make($credentials, [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->getMessageBag(), 422);
        }

        User::create($credentials);
        return response()->json(['message' => 'Successfully Saved!'], 200);
    }

    /**
     * Login function to login user.
     *
     * @return json
     */
    public function login()
    {
        $credentials = request()->input();

        if (! $token = Auth('api')->attempt($credentials)) {
            return response()->json('Username or password is wrong.', 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Profile function to get user's profile.
     *
     * @return json
     */
    public function profile()
    {
        if (! $userInfo = JWTAuth::parseToken()->authenticate()) {
            return response()->json('user_not_found', 404);
        }

        $user = User::findOrFail($userInfo->id);

        return response()->json($user->only('name', 'email', 'username', 'contact_number'));
    }

    /**
     * Update function to update user's profile.
     *
     * @return json
     */
    public function update()
    {
        $credentials = request()->input();

        if (! $userInfo = JWTAuth::parseToken()->authenticate()) {
            return response()->json('user_not_found', 404);
        }

        $user = User::findOrFail($userInfo->id);
        $user->update($credentials);

        return response()->json(['message' => 'Successfully updated!']);

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
