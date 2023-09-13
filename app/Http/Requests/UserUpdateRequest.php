<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|string',
            'phone_number' => 'required|numeric|digits:11|unique:users,phone_number,'.$this->route('user'),
            'remarks' => 'nullable|string',
        ];
        if ($this->isMethod('put')) {
            // Skip the unique validation for 'username' by excluding the current model's ID
            $rules['username'] = [
                'string',
                Rule::unique('users', 'username')->ignore($this->route('user')),
            ];
            $rules['email'] = [
                'string',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ];
        } else {
            // For create operations, apply the unique validation as before
            $rules['username'] = 'required|string|unique:users,username';
            $rules['email'] = 'required|string|unique:users,email';
        }
    }
}
