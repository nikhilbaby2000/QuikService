<?php

namespace App\Http\Requests\Auth\Registration;

use App\Http\Requests\BaseRequest;

class SendRegistrationOTPRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => 'required|mobile_number|unique:users,mobile',
        ];
    }
}
