<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Laravel\Passport\Client as OClient;

class AuthController extends Controller
{
    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $request['remember_token'] = Str::random(10);
        $request['password'] = Hash::make($request['password']);

        $user = User::create($request->toArray());

        return response()->json($user, 201);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $login = Arr::only($request->toArray(), ['email', 'password']);

        if (!Auth::attempt($login)) {
            return $this->unauthorized();
        }

        $objToken = $this->getAccessToken($request);

        return response()->json($objToken, 200);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId(
            $request->user()->token()->id
        );

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    /**
     * @return JsonResponse
     */
    public function unauthorized(): JsonResponse
    {
        return response()->json([ 'error' => 'Unauthorized' ], 401);
    }

    /**
     * @return array
     */
    public function getAccessToken(Request $request): array
    {
        $oClient = OClient::where('password_client', 1)->first();

        $response = Http::post(env('OAUTH_URL'), [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function refreshToken(Request $request): JsonResponse
    {
        $refreshToken = $request->header('refreshToken');

        $oClient = OClient::where('password_client', 1)->first();

        try {
            $response = Http::post(env('OAUTH_URL'), [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'scope' => '',
            ]);
            $objToken = json_decode((string) $response->getBody(), true);
            return response()->json($objToken, 200);
        } catch (Exception $e) {
            return $this->unauthorized();
        }
    }
}
