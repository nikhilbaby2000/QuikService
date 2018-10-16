<?php

namespace App\Http\Controllers\Verify;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignUpVerifyController extends Controller
{
    /**
     * Check if the shop name exists.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function shop(Request $request)
    {
        if (empty($username = slug($request->get('input')))) {
            return $this->respondSuccess([
                'available' => false
            ]);
        }

        $shop = Shop::where('slug', $username)->first();

        return $this->respondSuccess([
            'available' => empty($shop),
            'slug' => $username
        ]);
    }
}