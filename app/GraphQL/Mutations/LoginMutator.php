<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient;

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
            'token' => $objToken['access_token']
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
}
