<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            "password" => 'required|string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($response = response()->json([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors(),
            'status' => 422,
            'success' => false,
            'data' => null,
            'code' => 422,
            'type' => 'validation_error',
        ]));
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'email no valid',
            'email.exists' => 'email no exists',
            'password.required' => 'password is required',
        ];
    }
}
