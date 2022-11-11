<?php


namespace App\Http\Services\Auth\Api;


use App\Http\Services\Boilerplate\BaseService;
use Exception;

class LogoutService extends BaseService {

    /**
     * @var OAuthAccessTokenService
     */
    private $accessTokenService;

    public function __construct(OAuthAccessTokenService $accessTokenService) {
        $this->accessTokenService = $accessTokenService;
    }

    /**
     * @param object $request
     * @return array
     */
    public function logout(object $request): array {
        try {
            $token = $request->user()->token();
            if (empty($token)) return $this->response()->error();
            $token->revoke();
            $deleteToken = $this->accessTokenService->delete($token->id);
            if (!$deleteToken) throw new Exception($this->response()->error());

            return $this->response()->success('You have been successfully logged out!');
        } catch (Exception $e) {

            return $this->response()->error($e->getMessage());
        }
    }
}
