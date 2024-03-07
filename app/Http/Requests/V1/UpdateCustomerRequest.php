<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = request()->method();
        if ($method == 'PUT') {
            return [
                'name' => 'required',
                'email' => 'required|email',
                'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'postalCode' => 'required',
            ];
        } else {
            return [
                'name' => 'sometimes|required',
                'email' => 'sometimes|required|email',
                'type' => ['sometimes', 'required', Rule::in(['I', 'B', 'i', 'b'])],
                'state' => 'sometimes|required',
                'city' => 'sometimes|required',
                'address' => 'sometimes|required',
                'postalCode' => 'sometimes|required',
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->postalCode) {
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }
    }
}
