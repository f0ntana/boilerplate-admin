<?php

namespace App\Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'email' => 'required|email',
                        'password' => 'required|min:6'
                    ];
                }
        }
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
