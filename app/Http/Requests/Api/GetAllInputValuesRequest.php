<?php

namespace App\Http\Requests\Api;


use App\Http\Requests\Boilerplate\BaseValidation;

class GetAllInputValuesRequest extends BaseValidation {
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
            'start_datetime' => 'required|date_format:Y-m-d H:i:s',
            'end_datetime' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
    /**
     * @return array
     */
    public function messages(): array {
        return [
            'start_datetime.required' => __('Start datetime field can not be empty'),
            'end_datetime.required' => __('End datetime field can not be empty'),
            'start_datetime.date_format' => __('Invalid start data-time format, example: Y-m-d H:i:s'),
            'end_datetime.date_format' => __('Invalid end data-time format, example: Y-m-d H:i:s'),
        ];
    }
}
