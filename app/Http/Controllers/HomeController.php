<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{

    public function __invoke()
    {
        $user = auth()->user();

        return view('user.home', ['user' => $user]);
    }
}
