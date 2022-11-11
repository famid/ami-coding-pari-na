<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class KhojTheSearchRequest extends FormRequest
{
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
            'input_values' => 'required', 'string', 'max:255', 'regex:[0-9]+[.,]?[0-9]*',
        ];
    }
    /**
     * @return array
     */
    public function messages(): array {
        return [
            'input_values.required' => __('input_values field can not be empty'),
            'input_values.string' => __('input_values field must be string'),
            'input_values.max:255' => __('input_values field can not be empty'),
        ];
    }
}
