<?php

namespace App\Http\Requests\Auth\App;

use App\Http\Requests\BaseRequest;

class GenericAppLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|email|exists:users,email',
            'password'      => 'required',
        ];
    }
}
