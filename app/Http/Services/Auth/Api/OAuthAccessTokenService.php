<?php


namespace App\Http\Services\Auth\Api;


use App\Http\Repositories\OAuthAccessTokenRepository;
use App\Http\Services\Boilerplate\BaseService;
use Exception;

class OAuthAccessTokenService extends BaseService {

    /**
     * OAuthAccessTokenService constructor.
     * @param OAuthAccessTokenRepository $accessTokenRepository
     */
    public function __construct(OAuthAccessTokenRepository $accessTokenRepository) {
        $this->repository = $accessTokenRepository;
    }

    /**
     * @param string $tokenId
     * @return bool
     */
    public function delete(string $tokenId): bool {
        return $this->repository->deleteWhere(['id' => $tokenId]) > 0;
    }

    /**
     * @param object $user
     * @param object $request
     * @return array
     */
    public function getToken(object $user, object $request): array {
        try {
            $createTokenResponse = $user->createToken("Myapp")->accessToken;

            return empty($createTokenResponse) ?
                $this->response()->error() :
                $this->response($createTokenResponse)->success();
        } catch (Exception $e) {
            return $this->response()->error($e->getMessage());
        }
    }
}
