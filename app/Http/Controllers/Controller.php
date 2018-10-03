<?php

namespace App\Http\Controllers;

use App\QuikService\Helpers\ExceptionHelpers;
use Illuminate\Http\Request;
use App\Helpers\Response\ResponseHelpers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseHelpers, ExceptionHelpers;

    protected function hasValues(Request $request, $keys = [])
    {
        $data = array_filter($request->only($keys));

        return count($keys) == count($data);
    }

    public function otp()
    {
        $logs = explode("\n", file_get_contents(storage_path('logs/laravel.log')));

        $logs = array_filter($logs, function ($log) {
            return substr_exist($log, 'SMS Logger') || substr_exist($log, 'Mobile Number') || substr_exist($log, 'OTP is');
        });

        $otps = [];
        $mobile = $time = '';
        foreach ($logs as $log) {
            if (substr_exist($log, 'SMS Logger')) {
                $time = array_first(explode(']', str_replace('[', '', $log)));
            }

            if (substr_exist($log, 'Mobile Number')) {
                $mobile = str_replace('Mobile Number(s): ', '', $log);
            }

            if (substr_exist($log, 'OTP is')) {
                $otps[] = [
                    'mobile' => $mobile,
                    'otp_message' => $time . ': ' . str_replace('Message: ', '', $log),
                ];
            }
        }

        return array_values($otps);
    }
}
