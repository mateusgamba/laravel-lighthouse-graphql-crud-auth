<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient;
use App\GraphQL\Exceptions\CustomException;

class LoginMutator
{
    public function login($root, array $request): array
    {
        $request = Arr::except($request, 'directive');

        if (!Auth::attempt($request)) {
            return $this->unauthorized();
        }

        $objToken = $this->getAccessToken($request);

        return [
            'token' => $objToken['access_token'],
            'token_refresh' => $objToken['refresh_token'],
            'token_type' => $objToken['token_type'],
            'expires_in' => $objToken['expires_in'],
        ];
    }

    /**
     * @return array
     */
    public function getAccessToken(array $request): array
    {
        $oClient = OClient::where('password_client', 1)->first();

        $response = Http::post(env('OAUTH_URL'), [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $request['email'],
            'password' => $request['password'],
            'scope' => '',
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function refresh($rootValue, array $request): array
    {
        $request = Arr::only($request, ['refresh']);

        $oClient = OClient::where('password_client', 1)->first();

        try {
            $response = Http::post(env('OAUTH_URL'), [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request['refresh'],
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'scope' => '',
            ]);

            $objToken = json_decode((string) $response->getBody(), true);

            return [
                'token' => $objToken['access_token'],
                'token_refresh' => $objToken['refresh_token'],
                'token_type' => $objToken['token_type'],
                'expires_in' => $objToken['expires_in'],
            ];
        } catch(\Exception $e) {
            throw new CustomException(__('auth.failed'));
        }
    }
}
