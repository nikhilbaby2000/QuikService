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
}
