<?php
/**
 * Created by PhpStorm.
 * User: AkhilBaby
 * Date: 9/29/2018
 * Time: 4:40 PM
 */

namespace App\Http\Controllers\Shop;


use Illuminate\Http\Request;

class ShopDetailController extends BaseShopController
{
    public function show($shop_code, Request $request)
    {
        return view('shop.detail', [
            'name' => 'Shop Name'
        ]);
    }
}