<?php


namespace App\Http\Services\Boilerplate;


abstract class ResponseService {

    /**
     * @var array
     */
    public $response = [
        "success" => null,
        "message" => "",
        "data" => null
    ];

    /**
     * @var string
     */
    public $errorMessage = 'Something went wrong';

    /**
     * @param null $data
     * @return ResponseService
     */
    public function response($data = null): ResponseService {
        $this->response["data"] = $data;
        return $this;
    }

    /**
     * @param string $message
     * @return array
     */
    public function success(string $message=""): array {
        $this->response["success"] = true;
        $this->response["message"] = __($message);

        return $this->response;
    }

    /**
     * @param string $message
     * @return array
     */
    public function error(string $message=""): array {
        $this->response["success"] = false;
        $this->response["message"] = empty($message) ?
            __($this->errorMessage) :
            __($message);

        return $this->response;
    }

    /**
     * @param string $token
     * @param object $user
     * @return array
     */
    public function authenticateApiResponse(string $token, object $user): array {
        $message = "Congratulations! You have signed in successfully.";
        $authData = [
            'email_verified' => $user->email_verified == 1,
            'access_token' => $token,
            'access_type' => "Bearer",
            'user_data' => [
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
            ]
        ];

        return $this->response($authData)->success($message);
    }

}
