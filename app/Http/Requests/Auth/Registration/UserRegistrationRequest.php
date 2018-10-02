<?php

namespace App\Http\Requests\Auth\Registration;

use App\Http\Requests\BaseRequest;

class UserRegistrationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:50',
            'email'         => 'required|email|max:150|unique:users,email',
            'mobile_uuid'   => 'required|uuid|exists:mobile_otp_verifications,id,verified,1',
            'password'      => 'required|min:6|confirmed'
        ];
    }
}
