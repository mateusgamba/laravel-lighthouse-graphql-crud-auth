<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient;
use App\GraphQL\Exceptions\CustomException;

class AuthMutator
{
    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function login(?string $root, array $request): array
    {
        $request = Arr::except($request, 'directive');

        if (!Auth::attempt($request)) {
            return $this->unauthorized();
        }

        $request['username'] = $request['email'];
        unset($request['email']);

        return $this->oAuthRequest('password', $request);
    }

    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function refreshToken(?string $root, array $request): array
    {
        $refreshToken = $request['refresh_token'];

        $data = [ 'refresh_token' => $refreshToken ];

        return $this->oAuthRequest('refresh_token', $data);
    }

    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function logout(): array
    {
        $user = Auth::user();
        $tokenId = $user->token()->id;

        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');

        $tokenRepository->revokeAccessToken($tokenId);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);

        return ['message' => __('messages.logout')];
    }

    /**
     * @return CustomException
     */
    public function unauthorized(): CustomException
    {
        throw new CustomException(__('auth.failed'));
    }

    /**
     * @param string $grantType
     * @param array $data
     * @return array
     */
    public function oAuthRequest(string $grantType, array $data): array
    {
        $oClient = OClient::where('password_client', 1)->first();

        $dataClient = [
            'grant_type' => $grantType,
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'scope' => '',
        ];

        $parameters = array_merge($dataClient, $data);

        $response = Http::post(env('OAUTH_URL'), $parameters);

        if ($response->status() === 200) {
            return json_decode((string) $response->getBody(), true);
        }

        return $this->unauthorized();
    }
}
