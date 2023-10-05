<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Register new user.
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'phone' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();
        if (!is_null($user)) {
            return response()->json(['message' => 'User already exists with this email'], 422);
        }

        User::create($validated);

        return response()->json(['message' => 'Successfully created user'], 201);
    }

    /**
     * Recover password.
     */
    public function recoverPassword(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'email' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();
        if (!is_null($user)) {
            return response()->json(['message' => 'User not found'], 404);
        }

        /**
         * TODO!!!
         */

        return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     */
    public function signIn(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $token = Auth::attempt($validated);
        if (!$token) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Refresh a token.
     *
     * TODO: not implemented, as it not mentioned in the task.
     */
    public function refresh(): JsonResponse
    {
        throw new \Exception('Not implemented');

        // return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'user'         => auth()->user(),
            'expires_in'   => auth()->factory()->getTTL() * 60 * 24
        ]);
    }
}
