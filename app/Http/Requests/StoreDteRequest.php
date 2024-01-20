<?php

namespace App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreDteRequest extends FormRequest
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
            'branch_office_id' => ['required'],
            'cashier_id' => ['required'],
            'folio' => ['required'],
            'cash_amount' => ['required'],
            'card_amount' => ['required'],
            'subtotal' => ['required'],
            'tax' => ['required'],
            'total' => ['required'],
            'entrance_hour' => ['required'],
            'exit_hour' => ['required']
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
