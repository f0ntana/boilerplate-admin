<?php

namespace App\Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user)
            ],
            'role_id' => 'required|exists:roles,id'
        ];

        // rules for editing
        if ($this->method() === 'PUT') {
            unset($rules['password']);
            return $rules;
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
