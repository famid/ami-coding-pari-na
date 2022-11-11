<?php


namespace App\Http\Services;


use App\Http\Services\Boilerplate\BaseService;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Str;

class UserService extends BaseService {

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->repository = $userRepository;
    }

    /**
     * @param array $userData
     * @return array
     */
    public function create(array $userData): array {
        try {
            $user = $this->repository->create($userData);
            if(!$user) return $this->response()->error();

            return $this->response($user)
                ->success("Successfully Signed up!");
        } catch (Exception $e) {

            return $this->response()->error();
        }
    }


    /**
     * @param object $request
     * @param int|null $emailVerificationCode
     * @return array
     */
    public function prepareUserData(object $request, int $emailVerificationCode = null): array {
        return [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->get('password')),
            'role' => USER_ROLE,
            'status' => USER_ACTIVE_STATUS,
            'remember_token' => Str::random(10),
            'email_verification_code' => $emailVerificationCode
        ];
    }
}
