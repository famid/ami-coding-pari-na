<?php


namespace App\Http\Requests\Api;


use App\Http\Requests\Boilerplate\BaseValidation;

class SignUpRequest extends BaseValidation {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array {
        return [
            'first_name.required' => __('First Name field can not be empty'),
            'last_name.required' => __('Last Name field can not be empty'),
            'username.required' => __('UserName field can not be empty'),
            'email.required' => __('Email field can not be empty'),
            'email.email' => __('Invalid email address'),
            'password.required' => __('Password field can not be empty'),
            'password.min' => __('Password length must be at least 8 characters.'),
            'password.confirmed' => __('Password and confirm password is not matched'),
        ];
    }
}
