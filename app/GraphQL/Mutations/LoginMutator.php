<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient;
use App\GraphQL\Exceptions\CustomException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class LoginMutator
{
    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function login($root = null, array $request): array
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
    public function refresh($root = null, array $request, GraphQLContext $context): array
    {
        $refreshToken = $context->request()->header('refresh-token');

        $data = [ 'refresh_token' => $refreshToken ];

        return $this->oAuthRequest('refresh_token', $data);
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
        $dataClient = [
            'grant_type' => $grantType,
            'client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
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
