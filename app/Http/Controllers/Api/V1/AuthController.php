<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Sign up.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function register(StoreUserRequest $request): JsonResponse
    {
        $user = User::query()
            ->create($request->validated());

        return $this->respondWithToken(
            JWTAuth::fromUser($user),
            __('messages.logged_in')
        );
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['errors' =>  __('messages.unauthorized')], 401);
        }
        return $this->respondWithToken($token, __('messages.logged'));
    }

    /**
     * Get the authenticated User.
     */
    public function user(): UserResource
    {
        return new UserResource(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('api')->logout();
        return response()->json([
            'message' => __('messages.logged_out')
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh(), __('messages.been_changed'));
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param string $message
     * @return JsonResponse
     */
    protected function respondWithToken(string $token, string $message): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'message' => $message,
        ]);
    }
}


