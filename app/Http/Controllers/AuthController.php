<?php

namespace App\Http\Controllers;

use App\Contracts\Service\AuthServiceInterface;
use App\Contracts\Service\MailServiceInterface;
use App\Contracts\Service\UserServiceInterface;
use App\Contracts\Service\VerificationTokenServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService,
        protected MailServiceInterface $mailService,
        protected VerificationTokenServiceInterface $verificationTokenService,
        protected AuthServiceInterface $authService
    ) {
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

        // FIXME: move app logic to service layer, use try cache here
        $user = $this->userService->findByEmail($validated['email']);
        if (!is_null($user)) {
            return response()->json(['message' => 'User already exists with this email'], 422);
        }

        $user = $this->userService->create($validated);

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

        $user = $this->userService->findByEmail($validated['email']);
        if (is_null($user)) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = $this->verificationTokenService->makeVerificationToken($user);
        $this->mailService->sendRecovePasswordMail($user, $token);

        return response()->json(['message' => 'Check your email for the link to update your password'], 201);
    }

    /**
     * Verify recovery password.
     */
    public function recoverPasswordVerify(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'verification_token' => 'required|string',
            'new_password' => 'required|string',
        ]);

        $token = $this->verificationTokenService->findByToken($validated['verification_token']);
        if (is_null($token)) {
            return response()->json(['message' => 'Token not found'], 404);
        }

        $this->userService->updatePasswordByToken($token, $validated['new_password']);

        return response()->json(['message' => 'You password successfully updated'], 200);
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

        $token = $this->authService->attemptSignIn($validated);
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
