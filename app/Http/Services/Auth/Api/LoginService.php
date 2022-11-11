<?php


namespace App\Http\Services\Auth\Api;


use App\Http\Services\Boilerplate\BaseService;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginService extends BaseService {

    private OAuthAccessTokenService $accessTokenService;


    /**
     * @param OAuthAccessTokenService $accessTokenService
     */
    public function __construct(OAuthAccessTokenService $accessTokenService) {
        $this->accessTokenService = $accessTokenService;
    }

    /**
     * @param object $request
     * @return array
     */
    public function signIn(object $request): array {
        try {
            $credentials = $this->getCredentials($request->only('email','password'));
            if(!Auth::attempt($credentials))
                return $this->response()->error('User not found,please try again');

            $createTokenResponse = $this->accessTokenService->getToken(Auth::user(), $request);
            if (!$createTokenResponse['success']) return $this->response()->error();

            return $this->authenticateApiResponse(
                $createTokenResponse['data'],
                Auth::user(),
            );
        } catch (Exception $e) {

            return $this->response()->error($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function getCredentials(array $data): array {
        return filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? [
            'email' => $data['email'],
            'password' => $data['password']
        ] : [
            'username' => $data['email'],
            'password' => $data['password']
        ];
    }
}
