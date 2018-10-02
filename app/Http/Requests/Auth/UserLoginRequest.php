<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class UserLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isOTPLogin = array_filter(request()->only(['mobile', 'otp']));

        return !empty($isOTPLogin)
            ? [
                'mobile'    => 'required|mobile_number|exists:users,mobile',
                'otp'       => 'required|otp',
            ]
            : [
                'email'     => 'required|email|exists:users,email',
                'password'  => 'required',
            ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile.exists' => "User with that mobile number doesn't exist.",
        ];
    }
}
