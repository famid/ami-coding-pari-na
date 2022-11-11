<?php


namespace App\Http\Services\Auth\Api;


use App\Http\Services\Boilerplate\BaseService;
use App\Http\Services\UserService;
use Exception;
use Illuminate\Support\Facades\DB;

class RegisterService extends BaseService {

    private UserService $userService;
    private OAuthAccessTokenService $accessTokenService;


    /**
     * @param UserService $userService
     * @param OAuthAccessTokenService $accessTokenService
     */
    public function __construct(UserService $userService, OAuthAccessTokenService $accessTokenService) {
        $this->userService = $userService;
        $this->accessTokenService = $accessTokenService;
    }

    /**
     * @param object $request
     * @return array
     */
    public function signUp(object $request): array {
        try {
            DB::beginTransaction();
            $createUserResponse = $this->userService->create(
                $this->userService->prepareUserData($request, randomNumber(6))
            );
            if (!$createUserResponse['success']) return $this->response()->error($createUserResponse['message']);

            $createTokenResponse = $this->accessTokenService->getToken($createUserResponse['data'], $request);
            if (!$createTokenResponse['success']) return $this->response()->error();

            DB::commit();
            return $this->authenticateApiResponse(
                $createTokenResponse['data'],
                $createUserResponse['data'],
            );
        } catch (Exception $e) {
            Db::rollback();

            return $this->response()->error();
        }
    }
}
