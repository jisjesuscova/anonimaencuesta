<?php

namespace App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreBranchOfficeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    static public function myRules() {
        return [
            'branch_office' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'opening_date' => ['required']
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        if ($this->expectsJson()) {
            $response = new Response($validator->errors(), 422);

            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return $this->myRules();
    }
}
